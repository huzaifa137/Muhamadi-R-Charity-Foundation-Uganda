/* Lightweight, dependency-free SVG charts for the admin dashboard.
   Line, bar (grouped / stacked), donut, horizontal bars, sparkline, ring, heatmap. */
(function () {
  const COL = { green: '#3bb64b', deep: '#087d3f', dark: '#075a35', lime: '#8cc540', red: '#f01921', amber: '#f5a524', blue: '#2f80ed', sand: '#cdbd92' };
  const PAL = [COL.deep, COL.green, COL.lime, COL.amber, COL.blue, COL.red, COL.sand];
  let uid = 0;

  /* ---------- tooltip (event delegation on [data-tip]) ---------- */
  const tip = document.createElement('div');
  tip.className = 'chart-tip';
  document.addEventListener('DOMContentLoaded', () => document.body.appendChild(tip));
  document.addEventListener('mousemove', e => {
    const t = e.target.closest && e.target.closest('[data-tip]');
    if (!t) { tip.style.opacity = 0; return; }
    tip.innerHTML = t.getAttribute('data-tip');
    tip.style.opacity = 1;
    const w = tip.offsetWidth, h = tip.offsetHeight;
    let x = e.clientX + 16, y = e.clientY - h - 12;
    if (x + w > innerWidth - 8) x = e.clientX - w - 16;
    if (y < 8) y = e.clientY + 18;
    tip.style.left = x + 'px'; tip.style.top = y + 'px';
  });

  /* ---------- helpers ---------- */
  const fmtN = n => n >= 1e6 ? +(n / 1e6).toFixed(1) + 'M' : n >= 1e3 ? +(n / 1e3).toFixed(1) + 'k' : String(Math.round(n));
  function niceMax(v) { const p = Math.pow(10, Math.floor(Math.log10(v || 1))); const f = v / p; return (f <= 1 ? 1 : f <= 2 ? 2 : f <= 5 ? 5 : 10) * p; }
  function mount(el, draw) {
    if (typeof el === 'string') el = document.querySelector(el);
    if (!el) return;
    el.classList.add('chart');
    const run = () => { el._w = el.clientWidth; draw(el, el._w || 600); };
    run();
    if (!el._ro && window.ResizeObserver) {
      el._ro = new ResizeObserver(() => { if (Math.abs(el.clientWidth - el._w) > 3) run(); });
      el._ro.observe(el);
    }
    el._redraw = run;
    return el;
  }
  function smooth(pts) {
    if (pts.length < 2) return '';
    let d = `M${pts[0][0]},${pts[0][1]}`;
    for (let i = 0; i < pts.length - 1; i++) {
      const p0 = pts[i - 1] || pts[i], p1 = pts[i], p2 = pts[i + 1], p3 = pts[i + 2] || p2, t = 0.18;
      d += `C${p1[0] + (p2[0] - p0[0]) * t},${p1[1] + (p2[1] - p0[1]) * t} ${p2[0] - (p3[0] - p1[0]) * t},${p2[1] - (p3[1] - p1[1]) * t} ${p2[0]},${p2[1]}`;
    }
    return d;
  }

  /* ---------- LINE / AREA ---------- */
  function line(el, o) {
    mount(el, (el, W) => {
      const H = o.height || 290, L = 48, R = 14, T = 14, B = 30, iw = W - L - R, ih = H - T - B;
      const S = o.series, n = o.labels.length, fmt = o.format || fmtN;
      const max = niceMax(Math.max(...S.flatMap(s => s.data)) * 1.05), ticks = 4;
      const x = i => L + (n === 1 ? iw / 2 : (i / (n - 1)) * iw), y = v => T + ih - (v / max) * ih;
      const id = 'lg' + (++uid);
      let s = `<svg viewBox="0 0 ${W} ${H}" role="img"><defs>`;
      S.forEach((se, k) => { const c = se.color || PAL[k]; s += `<linearGradient id="${id}${k}" x1="0" y1="0" x2="0" y2="1"><stop offset="0" stop-color="${c}" stop-opacity=".28"/><stop offset="1" stop-color="${c}" stop-opacity="0"/></linearGradient>`; });
      s += '</defs>';
      for (let t = 0; t <= ticks; t++) { const v = (max / ticks) * t, yy = y(v); s += `<line class="ch-grid" x1="${L}" x2="${W - R}" y1="${yy}" y2="${yy}"/><text class="ch-axis" x="${L - 10}" y="${yy + 4}" text-anchor="end">${fmt(v)}</text>`; }
      const step = Math.ceil(n / Math.max(2, Math.floor(iw / 62)));
      o.labels.forEach((lb, i) => { if (i % step === 0 || i === n - 1) s += `<text class="ch-axis" x="${x(i)}" y="${H - 8}" text-anchor="middle">${lb}</text>`; });
      S.forEach((se, k) => {
        const c = se.color || PAL[k], pts = se.data.map((v, i) => [x(i), y(v)]), d = smooth(pts);
        if (se.fill !== false) s += `<path d="${d}L${x(n - 1)},${T + ih}L${x(0)},${T + ih}Z" fill="url(#${id}${k})"/>`;
        s += `<path class="ch-line" d="${d}" stroke="${c}" ${se.dash ? 'stroke-dasharray="6 6" style="animation:none;stroke-dashoffset:0"' : ''} />`;
      });
      const cw = iw / Math.max(1, n - 1);
      o.labels.forEach((lb, i) => {
        const tipHtml = `<b>${lb}</b><br>` + S.map((se, k) => `<i style="background:${se.color || PAL[k]}"></i>${se.name}: <b>${(o.tipFormat || fmt)(se.data[i])}</b>`).join('<br>');
        s += `<g class="hv"><rect class="hit" x="${x(i) - cw / 2}" y="${T}" width="${cw}" height="${ih}" data-tip='${tipHtml.replace(/'/g, '&#39;')}'/><g class="g" pointer-events="none"><line x1="${x(i)}" x2="${x(i)}" y1="${T}" y2="${T + ih}" stroke="#cfdcd2" stroke-dasharray="4 4"/>${S.map((se, k) => `<circle cx="${x(i)}" cy="${y(se.data[i])}" r="5" fill="#fff" stroke="${se.color || PAL[k]}" stroke-width="3"/>`).join('')}</g></g>`;
      });
      el.innerHTML = s + '</svg>';
      el.querySelectorAll('.ch-line').forEach(p => { if (p.getTotalLength) p.style.setProperty('--len', Math.ceil(p.getTotalLength()) + 2); });
    });
  }

  /* ---------- BAR (grouped or stacked) ---------- */
  function bar(el, o) {
    mount(el, (el, W) => {
      const H = o.height || 280, L = 48, R = 10, T = 14, B = 30, iw = W - L - R, ih = H - T - B;
      const S = o.series, n = o.labels.length, fmt = o.format || fmtN, st = o.stacked;
      const totals = o.labels.map((_, i) => st ? S.reduce((a, s) => a + s.data[i], 0) : Math.max(...S.map(s => s.data[i])));
      const max = niceMax(Math.max(...totals) * 1.05), ticks = 4, band = iw / n, gp = band * 0.28;
      const bw = st ? band - gp : (band - gp) / S.length, y = v => T + ih - (v / max) * ih;
      let s = `<svg viewBox="0 0 ${W} ${H}" role="img">`;
      for (let t = 0; t <= ticks; t++) { const v = (max / ticks) * t, yy = y(v); s += `<line class="ch-grid" x1="${L}" x2="${W - R}" y1="${yy}" y2="${yy}"/><text class="ch-axis" x="${L - 10}" y="${yy + 4}" text-anchor="end">${fmt(v)}</text>`; }
      const step = Math.ceil(n / Math.max(2, Math.floor(iw / 44)));
      o.labels.forEach((lb, i) => {
        const x0 = L + i * band + gp / 2;
        if (i % step === 0) s += `<text class="ch-axis" x="${L + i * band + band / 2}" y="${H - 8}" text-anchor="middle">${lb}</text>`;
        let acc = 0;
        S.forEach((se, k) => {
          const v = se.data[i], c = se.color || PAL[k], h = (v / max) * ih, bx = st ? x0 : x0 + k * bw, by = st ? y(acc + v) : y(v);
          const r = Math.min(6, bw / 2, h);
          const tp = `<b>${lb}</b><br><i style="background:${c}"></i>${se.name}: <b>${(o.tipFormat || fmt)(v)}</b>`.replace(/'/g, '&#39;');
          s += `<path class="ch-bar" style="animation-delay:${i * 25}ms" data-tip='${tp}' fill="${c}" d="M${bx},${by + h}V${by + r}Q${bx},${by} ${bx + r},${by}H${bx + bw - r}Q${bx + bw},${by} ${bx + bw},${by + r}V${by + h}Z"/>`;
          acc += v;
        });
      });
      el.innerHTML = s + '</svg>';
    });
  }

  /* ---------- DONUT ---------- */
  function donut(el, o) {
    mount(el, el => {
      const items = o.items, total = items.reduce((a, b) => a + b.value, 0), r = 62, C = 2 * Math.PI * r;
      let off = 0, seg = '';
      items.forEach((it, i) => {
        const c = it.color || PAL[i], len = (it.value / total) * C, gap = items.length > 1 ? 3 : 0;
        const tp = `<i style="background:${c}"></i>${it.label}: <b>${(o.tipFormat || fmtN)(it.value)}</b> (${Math.round((it.value / total) * 100)}%)`.replace(/'/g, '&#39;');
        seg += `<circle class="seg" cx="90" cy="90" r="${r}" fill="none" stroke="${c}" stroke-width="22" stroke-dasharray="${Math.max(0, len - gap)} ${C}" stroke-dashoffset="${-off}" transform="rotate(-90 90 90)" data-tip='${tp}'/>`;
        off += len;
      });
      const ctr = o.center ? `<text x="90" y="88" text-anchor="middle" style="font:800 22px Manrope,system-ui,sans-serif;fill:#17231d;letter-spacing:-.04em">${o.center.value}</text><text x="90" y="106" text-anchor="middle" style="font:700 10px Manrope,system-ui,sans-serif;fill:#8a958f">${o.center.label}</text>` : '';
      const lg = items.map((it, i) => `<li><i style="background:${it.color || PAL[i]}"></i>${it.label}<em>${o.legendPct === false ? (o.tipFormat || fmtN)(it.value) : Math.round((it.value / total) * 100) + '%'}</em></li>`).join('');
      el.innerHTML = `<div class="donut-wrap"><svg viewBox="0 0 180 180"><circle cx="90" cy="90" r="${r}" fill="none" stroke="#f0f3f0" stroke-width="22"/>${seg}${ctr}</svg><ul class="legend">${lg}</ul></div>`;
    });
  }

  /* ---------- HORIZONTAL BARS ---------- */
  function hbar(el, o) {
    mount(el, el => {
      const max = o.max || Math.max(...o.items.map(i => i.value)), fmt = o.format || (v => v.toLocaleString());
      el.innerHTML = `<div class="hbar">${o.items.map((it, i) => `<div class="hbar-row"><div class="top"><span>${it.label}</span><em>${fmt(it.value)}${it.note ? ' · ' + it.note : ''}</em></div><div class="progress ${it.tone || ''}"><i style="width:${Math.min(100, (it.value / max) * 100)}%;animation-delay:${i * 80}ms;${it.color ? 'background:' + it.color : ''}"></i></div></div>`).join('')}</div>`;
    });
  }

  /* ---------- SPARKLINE ---------- */
  function spark(el, data, color) {
    mount(el, el => {
      const W = 96, H = 34, mx = Math.max(...data), mn = Math.min(...data), c = color || COL.green, id = 'sp' + (++uid);
      const pts = data.map((v, i) => [(i / (data.length - 1)) * W, H - 4 - ((v - mn) / (mx - mn || 1)) * (H - 8)]), d = smooth(pts);
      el.innerHTML = `<svg viewBox="0 0 ${W} ${H}"><defs><linearGradient id="${id}" x1="0" y1="0" x2="0" y2="1"><stop offset="0" stop-color="${c}" stop-opacity=".3"/><stop offset="1" stop-color="${c}" stop-opacity="0"/></linearGradient></defs><path d="${d}L${W},${H}L0,${H}Z" fill="url(#${id})"/><path d="${d}" fill="none" stroke="${c}" stroke-width="2" stroke-linecap="round"/></svg>`;
    });
  }

  /* ---------- PROGRESS RING ---------- */
  function ring(el, pct, color, label) {
    mount(el, el => {
      const r = 40, C = 2 * Math.PI * r, c = color || COL.green;
      el.classList.add('ring');
      el.innerHTML = `<svg viewBox="0 0 100 100"><circle cx="50" cy="50" r="${r}" fill="none" stroke="#edf1ed" stroke-width="10"/><circle cx="50" cy="50" r="${r}" fill="none" stroke="${c}" stroke-width="10" stroke-linecap="round" stroke-dasharray="${(pct / 100) * C} ${C}"/></svg><b>${label || pct + '%'}</b>`;
    });
  }

  /* ---------- HEATMAP (7 days × 24h) ---------- */
  function heat(el, matrix, days) {
    mount(el, el => {
      const mx = Math.max(...matrix.flat());
      let h = '<div></div>' + Array.from({ length: 24 }, (_, i) => `<div style="text-align:center">${i % 6 === 0 ? i : ''}</div>`).join('');
      matrix.forEach((row, d) => {
        h += `<div>${days[d]}</div>`;
        row.forEach((v, hr) => { h += `<div class="c" style="opacity:${0.1 + (v / mx) * 0.9}" data-tip="<b>${days[d]} ${hr}:00</b><br>${v} visits"></div>`; });
      });
      el.innerHTML = `<div class="heat">${h}</div>`;
    });
  }

  window.Charts = { line, bar, donut, hbar, spark, ring, heat, COL, PAL, fmtN };
})();
