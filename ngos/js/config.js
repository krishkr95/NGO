/* ============================================================
   NGO WEBSITE — SITE CONFIGURATION
   [CONFIGURABLE] — Update all values marked with [Config] below.
   ============================================================ */

const NGO_CONFIG = {
  // ── Organisation Identity ──────────────────────────────────
  name:        'EmpowerHer',           // [Config] NGO full name
  tagline:     'Stitching Futures, Empowering Women',  // [Config]
  shortName:   'EmpowerHer',           // [Config]
  regNumber:   'REG/NGO/2018/XXXX',    // [Config] Registration number
  established: '2018',                 // [Config]

  // ── Contact ───────────────────────────────────────────────
  phone:    '+91 XXXXX XXXXX',         // [Config] Primary phone
  whatsapp: '91XXXXXXXXXX',            // [Config] WhatsApp number (no + or spaces)
  email:    'info@empowerher.org',     // [Config]
  address: {
    street: '[Street / Area Name]',    // [Config]
    city:   '[City]',                  // [Config]
    state:  '[State]',                 // [Config]
    pin:    'XXXXXX',                  // [Config]
    full:   '[Full Address, City, State – PIN]' // [Config]
  },

  // ── Social Media ──────────────────────────────────────────
  social: {
    facebook:  'https://facebook.com/empowerher',   // [Config]
    instagram: 'https://instagram.com/empowerher',  // [Config]
    youtube:   'https://youtube.com/@empowerher',   // [Config]
    linkedin:  'https://linkedin.com/company/empowerher' // [Config]
  },

  // ── Payment / Donation ────────────────────────────────────
  upiId:   '[upi@example]',            // [Config] UPI ID
  account: {
    name:   '[Account Name]',          // [Config]
    bank:   '[Bank Name]',             // [Config]
    acc:    'XXXXXXXXXXXX',            // [Config]
    ifsc:   'XXXXXXXXX',              // [Config]
    branch: '[Branch Name]'            // [Config]
  },

  // ── Impact Stats ─────────────────────────────────────────
  // These are used by the counter animation in JS
  // data-count attributes in HTML drive the counters
  stats: {
    peopleTrained:     500,   // [Configurable]
    womenEmpowered:    300,   // [Configurable]
    trainingPrograms:   25,   // [Configurable]
    garmentsProduced: 1500,   // [Configurable]
    communities:        10,   // [Configurable]
    volunteers:         50,   // [Configurable]
    trainingSessions:  120,   // [Configurable]
  },

  // ── WhatsApp Message Templates ────────────────────────────
  messages: {
    general:     'Hello EmpowerHer! I would like to know more about your programs and how I can get involved.',
    volunteer:   (name, area) => `Hello EmpowerHer! My name is ${name}. I am interested in volunteering as a ${area}. Please share details.`,
    donate:      (amount)     => `Hello EmpowerHer! I would like to donate ₹${amount} to support your mission. Please guide me on the next steps.`,
    partnership: 'Hello EmpowerHer! I represent an organization interested in exploring partnership / CSR collaboration with you. Please connect.',
    story:       (name)       => `Hello EmpowerHer! My name is ${name}. I am a program participant and would like to share my story with you.`,
    contact:     (name, subject, msg) => `Hello EmpowerHer!\n\nName: ${name}\nSubject: ${subject}\nMessage: ${msg}\n\nPlease get back to me.`,
    training:    'Hello EmpowerHer! I am interested in enrolling for your vocational training programs. Please share details.',
  },

  // ── Opening Hours ─────────────────────────────────────────
  hours: {
    weekdays: 'Monday – Friday: 10:00 AM – 6:00 PM',  // [Config]
    saturday: 'Saturday: 10:00 AM – 4:00 PM',          // [Config]
    sunday:   'Sunday: Closed',                         // [Config]
  },

  // ── Map ───────────────────────────────────────────────────
  googleMapsEmbedUrl: '', // [Config] Paste your Google Maps embed URL here

  // ── Google Analytics ─────────────────────────────────────
  gaId: '', // [Config] e.g. 'G-XXXXXXXXXX'
};

// Freeze to prevent accidental mutation
Object.freeze(NGO_CONFIG);

// Export for module environments (ignored in plain <script> usage)
if (typeof module !== 'undefined') module.exports = NGO_CONFIG;
