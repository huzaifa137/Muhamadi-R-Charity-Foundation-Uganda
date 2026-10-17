/* Shared UI behaviour: navigation, dropdowns, modals, tabs, toasts, forms, tables, drag & drop.
   Pure front-end — every action that would hit the server is marked with  // TODO(API)  */
(function () {
  const $ = (s, r = document) => r.querySelector(s);
  const $$ = (s, r = document) => [...r.querySelectorAll(s)];

  /* ---------- helpers exposed to pages ---------- */
  const UI = {
    ugx: n => 'UGX ' + Number(n).toLocaleString('en-UG'),
    ugxShort: n => n >= 1e6 ? 'UGX ' + +(n / 1e6).toFixed(1) + 'M' : n >= 1e3 ? 'UGX ' + Math.round(n / 1e3) + 'k' : 'UGX ' + n,
    date: d => d ? new Date(d.replace(' ', 'T')).toLocaleDateString('en-GB', { day: 'numeric', month: 'short', year: 'numeric' }) : '—',
    initials: n => n.split(/\s+/).filter(Boolean).slice(0, 2).map(w => w[0]).join('').toUpperCase(),
    icon: (n, c = '') => `<svg class="i ${c}"><use href="#i-${n}"/></svg>`,
    avatar(n, c = '', size = '') { return `<span class="avatar ${size} ${c}">${UI.initials(n)}</span>`; },
    tone: s => ({ Completed: 'green', Published: 'green', Live: 'green', Active: 'green', Replied: 'green', Agreement: 'green', Pending: 'amber', Draft: 'gray', Scheduled: 'blue', Screening: 'amber', Interview: 'blue', Discussion: 'blue', Enquiry: 'gray', New: 'red', Failed: 'red', Refunded: 'gray', Archived: 'gray', Invited: 'amber', Suspended: 'red' }[s] || 'gray'),
    pill: (s, t) => `<span class="pill ${UI.tone(s)}">${t || s}</span>`,
    toast(msg, type) {
      let w = $('.toasts'); if (!w) { w = document.createElement('div'); w.className = 'toasts'; document.body.appendChild(w); }
      const t = document.createElement('div'); t.className = 'toast ' + (type || '');
      t.innerHTML = UI.icon(type === 'err' ? 'x' : 'check') + `<span>${msg}</span>`;
      w.appendChild(t); setTimeout(() => { t.style.opacity = 0; t.style.transition = '.3s'; setTimeout(() => t.remove(), 300); }, 3200);
    },
    open(id) { const o = document.getElementById(id); if (o) o.classList.add('open'); },
    close(el) { (el.closest ? el.closest('.overlay') : el).classList.remove('open'); },
    confirm(opts, cb) {
      const m = $('#confirm-modal'); if (!m) return cb && cb();
      $('#confirm-title', m).textContent = opts.title || 'Are you sure?';
      $('#confirm-text', m).textContent = opts.text || 'This action cannot be undone.';
      const ok = $('#confirm-ok', m); ok.textContent = opts.ok || 'Delete';
      ok.onclick = () => { m.classList.remove('open'); cb && cb(); };
      m.classList.add('open');
    },
    markDirty() { $$('.save-bar').forEach(b => { b.classList.add('dirty'); const s = $('.state span', b); if (s) s.textContent = 'Unsaved changes'; }); const d = $('#publish-dot'); if (d) d.classList.remove('hidden'); },
    markSaved() { $$('.save-bar').forEach(b => { b.classList.remove('dirty'); const s = $('.state span', b); if (s) s.textContent = 'All changes saved as draft'; }); }
  };
  window.UI = UI;

  document.addEventListener('DOMContentLoaded', () => {
    /* sidebar */
    $$('[data-nav-toggle]').forEach(b => b.addEventListener('click', () => document.body.classList.toggle('nav-open')));
    document.addEventListener('click', e => { if (document.body.classList.contains('nav-open') && !e.target.closest('.sidebar') && !e.target.closest('[data-nav-toggle]')) document.body.classList.remove('nav-open'); });

    /* dropdowns */
    $$('.dropdown > [data-dd]').forEach(b => b.addEventListener('click', e => {
      e.stopPropagation(); const d = b.parentElement, was = d.classList.contains('open');
      $$('.dropdown.open').forEach(x => x.classList.remove('open')); if (!was) d.classList.add('open');
    }));
    document.addEventListener('click', e => { if (!e.target.closest('.dropdown')) $$('.dropdown.open').forEach(x => x.classList.remove('open')); });

    /* modals / drawers */
    document.addEventListener('click', e => {
      const op = e.target.closest('[data-open]'); if (op) { e.preventDefault(); UI.open(op.dataset.open); }
      const cl = e.target.closest('[data-close]'); if (cl) UI.close(cl);
      if (e.target.classList.contains('overlay')) e.target.classList.remove('open');
    });
    document.addEventListener('keydown', e => {
      if (e.key === 'Escape') $$('.overlay.open').forEach(o => o.classList.remove('open'));
      if ((e.ctrlKey || e.metaKey) && e.key.toLowerCase() === 'k') { e.preventDefault(); const s = $('.topbar .search input'); if (s) s.focus(); }
    });

    /* tabs */
    $$('.tabs').forEach(tabs => {
      const scope = tabs.dataset.scope ? document.getElementById(tabs.dataset.scope) : document;
      $$('.tab', tabs).forEach(t => t.addEventListener('click', () => {
        $$('.tab', tabs).forEach(x => x.classList.toggle('active', x === t));
        $$(':scope .tab-panel', scope === document ? document.body : scope).forEach(p => { if (p.dataset.group === tabs.dataset.group) p.classList.toggle('active', p.id === t.dataset.tab); });
        history.replaceState(null, '', '#' + t.dataset.tab);
      }));
    });
    if (location.hash) { const t = $(`.tab[data-tab="${location.hash.slice(1)}"]`); if (t) t.click(); }

    /* segmented chips (data-range / data-chip) */
    $$('.chips[data-single] .chip').forEach(c => c.addEventListener('click', () => { $$('.chip', c.parentElement).forEach(x => x.classList.toggle('active', x === c)); }));

    /* dirty tracking */
    $$('[data-track]').forEach(f => { f.addEventListener('input', UI.markDirty); f.addEventListener('change', UI.markDirty); });
    $$('[data-save]').forEach(b => b.addEventListener('click', e => { e.preventDefault(); /* TODO(API): persist draft */ UI.markSaved(); UI.toast(b.dataset.save || 'Changes saved as draft'); }));
    $$('[data-publish]').forEach(b => b.addEventListener('click', e => { e.preventDefault(); /* TODO(API): publish to live website */ UI.markSaved(); const d = $('#publish-dot'); if (d) d.classList.add('hidden'); UI.toast('Changes published to the live website'); }));

    /* delete */
    document.addEventListener('click', e => {
      const d = e.target.closest('[data-delete]'); if (!d) return;
      const row = d.closest('tr, .kcard, .item-card, .media, .rep-item, .person, .card, .mail-item');
      UI.confirm({ title: d.dataset.title || 'Delete this item?', text: d.dataset.text || 'It will be removed from the dashboard and the public website.' }, () => { /* TODO(API): DELETE */ if (row) { row.style.transition = '.3s'; row.style.opacity = 0; setTimeout(() => row.remove(), 280); } UI.toast('Item deleted'); });
    });

    /* dropzones & image fields */
    $$('.dropzone').forEach(z => {
      const inp = $('input[type=file]', z);
      ['dragover', 'dragenter'].forEach(ev => z.addEventListener(ev, e => { e.preventDefault(); z.classList.add('over'); }));
      ['dragleave', 'drop'].forEach(ev => z.addEventListener(ev, e => { e.preventDefault(); z.classList.remove('over'); }));
      z.addEventListener('drop', e => { if (inp) { inp.files = e.dataTransfer.files; inp.dispatchEvent(new Event('change')); } });
      if (inp) inp.addEventListener('change', () => { if (inp.files.length) { UI.toast(inp.files.length + ' file' + (inp.files.length > 1 ? 's' : '') + ' ready to upload'); UI.markDirty(); const cb = window[z.dataset.onfiles]; if (cb) cb(inp.files); } });
    });
    $$('.img-field').forEach(f => {
      const inp = $('input[type=file]', f), pv = $('.pv', f);
      if (inp) inp.addEventListener('change', () => { if (inp.files[0]) { pv.style.backgroundImage = `url(${URL.createObjectURL(inp.files[0])})`; UI.markDirty(); } });
    });

    /* repeaters */
    $$('[data-add]').forEach(b => b.addEventListener('click', () => {
      const tpl = document.getElementById(b.dataset.add), host = document.getElementById(b.dataset.into);
      if (tpl && host) { host.appendChild(tpl.content.cloneNode(true)); UI.markDirty(); }
    }));

    /* tag inputs */
    $$('.tags').forEach(t => {
      const inp = $('input', t);
      t.addEventListener('click', e => { if (e.target.closest('button')) { e.target.closest('span').remove(); UI.markDirty(); } else inp.focus(); });
      inp.addEventListener('keydown', e => { if ((e.key === 'Enter' || e.key === ',') && inp.value.trim()) { e.preventDefault(); const s = document.createElement('span'); s.innerHTML = `${inp.value.trim()} <button type="button">${UI.icon('x', 'i-sm')}</button>`; t.insertBefore(s, inp); inp.value = ''; UI.markDirty(); } });
    });

    /* rich-text toolbar */
    $$('.editor-bar [data-cmd]').forEach(b => b.addEventListener('mousedown', e => { e.preventDefault(); document.execCommand(b.dataset.cmd, false, b.dataset.val || null); UI.markDirty(); }));

    /* character counters */
    $$('[data-count]').forEach(el => { const out = document.getElementById(el.dataset.count), max = el.getAttribute('maxlength'); const u = () => { out.textContent = el.value.length + (max ? ' / ' + max : ''); }; el.addEventListener('input', u); u(); });

    /* table search + chip filter + select all */
    $$('[data-filter]').forEach(inp => inp.addEventListener('input', () => {
      const q = inp.value.toLowerCase(), scope = document.getElementById(inp.dataset.filter);
      $$('tbody tr, .item-card, .media, .mail-item, .person', scope).forEach(r => { r.classList.toggle('hidden', !r.textContent.toLowerCase().includes(q) && !(r.querySelector('img') && (r.querySelector('img').alt || '').toLowerCase().includes(q))); });
    }));
    $$('[data-chipfilter]').forEach(wrap => $$('.chip', wrap).forEach(c => c.addEventListener('click', () => {
      $$('.chip', wrap).forEach(x => x.classList.toggle('active', x === c));
      const val = c.dataset.val, scope = document.getElementById(wrap.dataset.chipfilter);
      $$('[data-status]', scope).forEach(r => r.classList.toggle('hidden', val !== 'all' && r.dataset.status !== val));
    })));
    $$('[data-selectall]').forEach(cb => cb.addEventListener('change', () => $$('tbody input[type=checkbox]', document.getElementById(cb.dataset.selectall)).forEach(x => x.checked = cb.checked)));

    /* kanban drag & drop */
    let dragged = null;
    document.addEventListener('dragstart', e => { const c = e.target.closest('.kcard'); if (c) { dragged = c; e.dataTransfer.effectAllowed = 'move'; setTimeout(() => c.style.opacity = .4, 0); } });
    document.addEventListener('dragend', () => { if (dragged) dragged.style.opacity = 1; dragged = null; $$('.kcol').forEach(updateCount); });
    document.addEventListener('dragover', e => { if (e.target.closest('.kcol-body')) e.preventDefault(); });
    document.addEventListener('drop', e => { const col = e.target.closest('.kcol-body'); if (col && dragged) { col.appendChild(dragged); UI.toast('Moved to “' + col.parentElement.querySelector('h4 span').textContent + '”'); } });
    function updateCount(c) { const n = c.querySelectorAll('.kcard').length, e = c.querySelector('h4 em'); if (e) e.textContent = n; }
    $$('.kcol').forEach(updateCount);

    /* password reveal */
    $$('[data-reveal]').forEach(b => b.addEventListener('click', () => { const i = document.getElementById(b.dataset.reveal); i.type = i.type === 'password' ? 'text' : 'password'; }));

    /* colour pickers mirror their text value */
    $$('input[type=color]').forEach(c => { const t = c.parentElement.querySelector('input[type=text]'); if (t) { c.addEventListener('input', () => t.value = c.value); t.addEventListener('input', () => { if (/^#[0-9a-f]{6}$/i.test(t.value)) c.value = t.value; }); } });

    /* flag placeholder fields that still contain [ADD ...] text */
    $$('input[value*="[ADD"], textarea').forEach(el => { if (/\[ADD/i.test(el.value || '')) el.classList.add('placeholder-flag'); });
  });
})();
