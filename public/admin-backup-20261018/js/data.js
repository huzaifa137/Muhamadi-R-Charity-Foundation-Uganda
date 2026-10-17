/* ============================================================
   Sample data used to populate the dashboard UI.
   Every collection below maps 1:1 to a future API/database table.
   Replace window.DB with real fetch() calls when the back end is ready.
   ============================================================ */
window.DB = {
  months: ['Nov', 'Dec', 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
  donationsMonthly: [2100000, 2850000, 3200000, 2600000, 3900000, 4400000, 3700000, 4800000, 5200000, 4600000, 5900000, 6400000],
  donationsPrev:    [1500000, 1900000, 2300000, 2100000, 2600000, 3100000, 2900000, 3300000, 3600000, 3500000, 4100000, 4300000],
  donationsDaily:   [180000, 240000, 150000, 310000, 220000, 390000, 280000, 260000, 340000, 410000, 300000, 370000, 450000, 380000],
  donationsWeekly:  [820000, 1050000, 960000, 1320000, 1180000, 1540000, 1710000, 1620000, 1890000, 2050000, 1930000, 2260000],
  purposes: [
    { label: 'Food & Essential Support', value: 18600000 },
    { label: 'Children & Family', value: 11900000 },
    { label: 'Community Outreach', value: 9800000 },
    { label: 'Community Development', value: 5900000 },
    { label: 'General / Unrestricted', value: 3400000 }
  ],
  methods: [
    { label: 'Mobile Money', value: 27400000 },
    { label: 'Bank transfer', value: 12100000 },
    { label: 'International card', value: 7300000 },
    { label: 'Cash / in person', value: 2800000 }
  ],
  traffic30: Array.from({ length: 30 }, (_, i) => Math.round(300 + i * 8 + 60 * Math.sin(i * 1.1) + ((i + 3) % 7 >= 5 ? 90 : 0))),
  pageviews30: Array.from({ length: 30 }, (_, i) => Math.round((300 + i * 8 + 60 * Math.sin(i * 1.1) + ((i + 3) % 7 >= 5 ? 90 : 0)) * 2.5)),
  sources: [
    { label: 'Direct', value: 3120 }, { label: 'WhatsApp & social', value: 4480 }, { label: 'Google search', value: 2760 },
    { label: 'Referral / partners', value: 1380 }, { label: 'Email', value: 660 }
  ],
  devices: [{ label: 'Mobile', value: 7640 }, { label: 'Desktop', value: 3920 }, { label: 'Tablet', value: 840 }],
  topPages: [
    { label: 'Home', value: 5210 }, { label: 'Get Involved', value: 2980 }, { label: 'Gallery', value: 2410 },
    { label: 'Our Impact', value: 1760 }, { label: 'What We Do', value: 1420 }, { label: 'Stories', value: 1190 }, { label: 'Contact', value: 960 }
  ],
  locations: [
    { label: 'Kampala', value: 4120 }, { label: 'Wakiso', value: 1880 }, { label: 'Mukono', value: 1210 }, { label: 'Jinja', value: 760 },
    { label: 'Gulu', value: 540 }, { label: 'United Kingdom', value: 480 }, { label: 'United States', value: 410 }
  ],
  heat: Array.from({ length: 7 }, (_, d) => Array.from({ length: 24 }, (_, h) => Math.max(1, Math.round((h > 6 && h < 23 ? 8 + 22 * Math.exp(-Math.pow(h - 19, 2) / 28) + 12 * Math.exp(-Math.pow(h - 12, 2) / 20) : 2) * (d > 4 ? 1.25 : 1) * (0.7 + ((d * 7 + h * 13) % 10) / 16))))),

  donations: [
    { id: 'DN-1048', donor: 'Aisha Nakato', email: 'aisha.n@example.com', amount: 250000, method: 'Mobile Money', purpose: 'Food & Essential Support', date: '2026-10-09', status: 'Completed' },
    { id: 'DN-1047', donor: 'Kato & Sons Ltd', email: 'accounts@katosons.example', amount: 1500000, method: 'Bank transfer', purpose: 'Children & Family', date: '2026-10-08', status: 'Completed' },
    { id: 'DN-1046', donor: 'Daniel Okello', email: 'dokello@example.com', amount: 80000, method: 'Mobile Money', purpose: 'General / Unrestricted', date: '2026-10-08', status: 'Pending' },
    { id: 'DN-1045', donor: 'Sarah Whitfield', email: 'sarah.w@example.co.uk', amount: 420000, method: 'International card', purpose: 'Community Outreach', date: '2026-10-07', status: 'Completed' },
    { id: 'DN-1044', donor: 'Anonymous', email: '—', amount: 100000, method: 'Cash / in person', purpose: 'Food & Essential Support', date: '2026-10-06', status: 'Completed' },
    { id: 'DN-1043', donor: 'Grace Namuli', email: 'grace.n@example.com', amount: 60000, method: 'Mobile Money', purpose: 'Children & Family', date: '2026-10-05', status: 'Failed' },
    { id: 'DN-1042', donor: 'Mukwano Community Group', email: 'info@mukwano.example', amount: 900000, method: 'Bank transfer', purpose: 'Community Development', date: '2026-10-04', status: 'Completed' },
    { id: 'DN-1041', donor: 'Ibrahim Ssemakula', email: 'ibra.s@example.com', amount: 150000, method: 'Mobile Money', purpose: 'Food & Essential Support', date: '2026-10-03', status: 'Completed' },
    { id: 'DN-1040', donor: 'Rebecca Achieng', email: 'r.achieng@example.com', amount: 200000, method: 'Mobile Money', purpose: 'Community Outreach', date: '2026-10-02', status: 'Refunded' },
    { id: 'DN-1039', donor: 'Michael Turner', email: 'm.turner@example.com', amount: 650000, method: 'International card', purpose: 'Children & Family', date: '2026-10-01', status: 'Completed' }
  ],

  messages: [
    { id: 1, name: 'Peter Mugisha', email: 'peter.m@example.com', phone: '+256 772 000 111', subject: 'Partnership', title: 'Partnership proposal — school feeding', date: '2026-10-10 09:12', unread: true, body: 'Good morning,\n\nI represent a local agribusiness that would like to explore supporting your food and essential assistance work. We can provide produce at cost for community distributions.\n\nCould we arrange a call next week to discuss scope and reporting expectations?\n\nKind regards,\nPeter Mugisha' },
    { id: 2, name: 'Esther Nabirye', email: 'esther.n@example.com', phone: '+256 701 000 222', subject: 'Volunteer', title: 'Interested in volunteering on weekends', date: '2026-10-10 07:40', unread: true, body: 'Hello team,\n\nI am a nurse based in Kampala and I would love to volunteer during outreach days. I am available on Saturdays.\n\nWhat are the next steps?\n\nThank you,\nEsther' },
    { id: 3, name: 'Johnson Lule', email: 'jlule@example.com', phone: '', subject: 'Donation / support', title: 'Question about mobile money donation', date: '2026-10-09 18:05', unread: true, body: 'Hi,\n\nI tried to donate through mobile money but I could not find the account name. Could you confirm the correct number to use?\n\nThanks,\nJohnson' },
    { id: 4, name: 'Clara Atim', email: 'clara@dailyvoice.example', phone: '+256 755 000 333', subject: 'Media / story', title: 'Interview request — community work feature', date: '2026-10-08 14:21', unread: false, body: 'Dear Foundation,\n\nI am a reporter preparing a feature on community-led charities in Uganda. May I schedule a short interview with a representative?\n\nBest,\nClara Atim' },
    { id: 5, name: 'Hassan Kigozi', email: 'hassan.k@example.com', phone: '', subject: 'General enquiry', title: 'Where is your office located?', date: '2026-10-07 11:30', unread: false, body: 'Hello, I would like to visit your office. Please share the address and opening hours.\n\nRegards, Hassan' },
    { id: 6, name: 'Linda Pearson', email: 'linda.p@example.org', phone: '+44 7700 900123', subject: 'Donation / support', title: 'International giving options', date: '2026-10-06 16:48', unread: false, body: 'Hi, I live in the UK and would like to give regularly. Do you accept international bank transfers or card payments?\n\nThank you, Linda' },
    { id: 7, name: 'Moses Opio', email: 'moses.o@example.com', phone: '', subject: 'Partnership', title: 'University outreach collaboration', date: '2026-10-04 10:02', unread: false, body: 'Greetings, our student society wants to organise a drive in support of your work. Can we discuss how to do this properly?\n\nMoses' }
  ],

  volunteers: [
    { id: 'V-031', name: 'Esther Nabirye', email: 'esther.n@example.com', phone: '+256 701 000 222', area: 'Community activities', availability: 'Weekends', applied: '2026-10-10', stage: 'New' },
    { id: 'V-030', name: 'Brian Ocen', email: 'brian.o@example.com', phone: '+256 772 555 019', area: 'Skills & expertise', availability: 'Evenings', applied: '2026-10-08', stage: 'New' },
    { id: 'V-029', name: 'Joan Namatovu', email: 'joan.n@example.com', phone: '+256 782 100 441', area: 'Advocacy & awareness', availability: 'Flexible', applied: '2026-10-05', stage: 'Screening' },
    { id: 'V-028', name: 'Samuel Byaruhanga', email: 'sam.b@example.com', phone: '+256 701 889 220', area: 'Community activities', availability: 'Weekends', applied: '2026-10-02', stage: 'Screening' },
    { id: 'V-027', name: 'Patricia Auma', email: 'pat.a@example.com', phone: '+256 759 330 718', area: 'Skills & expertise', availability: 'Weekdays', applied: '2026-09-28', stage: 'Interview' },
    { id: 'V-026', name: 'Isaac Mwesigwa', email: 'isaac.m@example.com', phone: '+256 703 441 009', area: 'Community activities', availability: 'Weekends', applied: '2026-09-24', stage: 'Interview' },
    { id: 'V-025', name: 'Florence Akello', email: 'flo.a@example.com', phone: '+256 775 220 332', area: 'Advocacy & awareness', availability: 'Evenings', applied: '2026-09-18', stage: 'Active' },
    { id: 'V-024', name: 'David Kizza', email: 'david.k@example.com', phone: '+256 706 100 998', area: 'Community activities', availability: 'Weekends', applied: '2026-09-12', stage: 'Active' }
  ],

  partners: [
    { id: 'P-012', org: 'Mukwano Community Group', contact: 'Ruth Mukwano', type: 'Community group', interest: 'Project support', stage: 'Active', since: '2026-06' },
    { id: 'P-011', org: 'Kato & Sons Ltd', contact: 'Francis Kato', type: 'Company', interest: 'Resources / funding', stage: 'Agreement', since: '2026-08' },
    { id: 'P-010', org: 'Peter Mugisha Agribusiness', contact: 'Peter Mugisha', type: 'Company', interest: 'In-kind (produce)', stage: 'Discussion', since: '2026-10' },
    { id: 'P-009', org: 'Makerere Student Society', contact: 'Moses Opio', type: 'Institution', interest: 'Fundraising drive', stage: 'Enquiry', since: '2026-10' },
    { id: 'P-008', org: 'Hope Bridge UK', contact: 'Linda Pearson', type: 'NGO', interest: 'Regular giving', stage: 'Discussion', since: '2026-09' },
    { id: 'P-007', org: 'Kampala Youth Radio', contact: 'Clara Atim', type: 'Media', interest: 'Communications', stage: 'Active', since: '2026-05' }
  ],

  campaigns: [
    { id: 'C-004', title: 'Food Support for 500 Families', goal: 20000000, raised: 14250000, donors: 112, end: '2026-12-15', status: 'Live', img: '../assets/images/food-support.webp' },
    { id: 'C-003', title: 'Back-to-School Support for Children', goal: 12000000, raised: 8940000, donors: 86, end: '2026-11-30', status: 'Live', img: '../assets/images/children.webp' },
    { id: 'C-002', title: 'Community Outreach Days', goal: 6000000, raised: 6000000, donors: 64, end: '2026-09-30', status: 'Completed', img: '../assets/images/outreach.webp' },
    { id: 'C-005', title: 'Women & Community Livelihoods', goal: 15000000, raised: 0, donors: 0, end: '2027-02-28', status: 'Draft', img: '../assets/images/women-community.webp' }
  ],

  stories: [
    { id: 'S-007', title: 'When community gathers, support becomes visible', category: 'Field work', author: 'Editorial team', date: '2026-10-05', status: 'Published', featured: true, views: 842, img: '../assets/images/community-group.webp' },
    { id: 'S-006', title: 'Keeping children visible in community support', category: 'Community', author: 'Editorial team', date: '2026-09-27', status: 'Published', featured: false, views: 611, img: '../assets/images/children.webp' },
    { id: 'S-005', title: 'From need to practical response', category: 'Field work', author: 'Programs desk', date: '2026-09-14', status: 'Published', featured: false, views: 497, img: '../assets/images/field-work.webp' },
    { id: 'S-004', title: 'Listening as the first step', category: 'Community', author: 'Programs desk', date: '2026-09-02', status: 'Published', featured: false, views: 388, img: '../assets/images/outreach.webp' },
    { id: 'S-008', title: 'Annual outreach day: what we learned', category: 'Announcements', author: 'Editorial team', date: '', status: 'Draft', featured: false, views: 0, img: '../assets/images/support-action.webp' },
    { id: 'S-009', title: 'Thank you to our October donors', category: 'Announcements', author: 'Communications', date: '2026-10-20', status: 'Scheduled', featured: false, views: 0, img: '../assets/images/community-support.webp' },
    { id: 'S-003', title: 'Women leading local action', category: 'Community', author: 'Programs desk', date: '2026-08-19', status: 'Archived', featured: false, views: 273, img: '../assets/images/women-community.webp' }
  ],

  programs: [
    { id: 1, no: '01', tag: 'Essential support', title: 'Food & Essential Assistance', desc: 'Support that responds to immediate practical needs while maintaining dignity and respectful community engagement.', objectives: ['Respond to identified essential needs.', 'Coordinate support transparently.'], img: '../assets/images/food-support.webp', status: 'Published', reach: 420 },
    { id: 2, no: '02', tag: 'Children & families', title: 'Children & Family Wellbeing', desc: 'Keeping children and families visible in community support efforts, with attention to dignity, care and inclusion.', objectives: ['Center children and family needs in support conversations.', 'Strengthen safe, respectful community participation.'], img: '../assets/images/children.webp', status: 'Published', reach: 310 },
    { id: 3, no: '03', tag: 'Outreach', title: 'Community Outreach', desc: 'Building relationships through direct engagement, community gatherings and practical support activities.', objectives: ['Listen to community priorities.', 'Connect people with appropriate support.'], img: '../assets/images/outreach.webp', status: 'Published', reach: 190 },
    { id: 4, no: '04', tag: 'Community development', title: 'Community Development', desc: 'Supporting practical local action and participation as part of a longer-term approach to stronger communities.', objectives: ['Encourage community participation.', 'Support practical local initiatives where appropriate.'], img: '../assets/images/project.webp', status: 'Published', reach: 120 }
  ],

  team: [
    { name: 'Muhamadi R.', role: 'Founder & Director', email: 'director@muhamadircharity.org', c: '' },
    { name: 'Amina Nalubega', role: 'Programs Coordinator', email: 'programs@muhamadircharity.org', c: 'red' },
    { name: 'Joseph Lubega', role: 'Finance & Accountability', email: 'finance@muhamadircharity.org', c: 'amber' },
    { name: 'Rose Namukasa', role: 'Community Liaison', email: 'community@muhamadircharity.org', c: 'blue' },
    { name: 'Tonny Ssebuliba', role: 'Communications Officer', email: 'comms@muhamadircharity.org', c: 'sand' },
    { name: 'Faith Akol', role: 'Volunteer Coordinator', email: 'volunteers@muhamadircharity.org', c: 'red' }
  ],

  users: [
    { name: 'Muhamadi R.', email: 'director@muhamadircharity.org', role: 'Super Admin', last: 'Today, 09:41', status: 'Active', c: '' },
    { name: 'Tonny Ssebuliba', email: 'comms@muhamadircharity.org', role: 'Editor', last: 'Today, 08:15', status: 'Active', c: 'sand' },
    { name: 'Joseph Lubega', email: 'finance@muhamadircharity.org', role: 'Finance', last: 'Yesterday, 17:02', status: 'Active', c: 'amber' },
    { name: 'Faith Akol', role: 'Volunteer Manager', email: 'volunteers@muhamadircharity.org', last: '3 days ago', status: 'Active', c: 'red' },
    { name: 'Guest Reviewer', role: 'Viewer', email: 'reviewer@example.com', last: '2 weeks ago', status: 'Invited', c: 'blue' }
  ],

  activity: [
    { ic: 'wallet', tone: '', t: 'New donation of UGX 250,000 received', s: 'Aisha Nakato · Mobile Money', when: '2h ago' },
    { ic: 'mail', tone: 'blue', t: 'New message: Partnership proposal', s: 'Peter Mugisha · via Contact form', when: '3h ago' },
    { ic: 'users', tone: 'amber', t: 'Volunteer application submitted', s: 'Esther Nabirye · Community activities', when: '5h ago' },
    { ic: 'file', tone: '', t: 'Story published: “When community gathers…”', s: 'by Tonny Ssebuliba', when: 'Yesterday' },
    { ic: 'image', tone: 'blue', t: '12 photos added to Gallery · Field Work', s: 'by Amina Nalubega', when: 'Yesterday' },
    { ic: 'target', tone: 'red', t: 'Campaign reached 71% of goal', s: 'Food Support for 500 Families', when: '2 days ago' },
    { ic: 'settings', tone: 'amber', t: 'Contact details updated', s: 'by Muhamadi R.', when: '3 days ago' }
  ]
};
