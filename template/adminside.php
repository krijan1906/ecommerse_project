<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>LUXE — Premium Admin Dashboard</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Playfair+Display:wght@600;700;800&display=swap" rel="stylesheet">
<style>
/* ════════════════════════════════════
   CSS VARIABLES & RESET
════════════════════════════════════ */
:root {
  --black:  #0a0a0a;
  --dark:   #0f1117;
  --dark2:  #16181f;
  --card:   #1a1d26;
  --card-hover: #1e212b;
  --border: #252831;
  --border-light: #2d3039;
  --gold:   #d4af37;
  --gold2:  #f4d03f;
  --gold-dark: #b8941f;
  --white:  #f8f9fa;
  --gray:   #8b8e98;
  --gray-light: #a8abb5;
  --light:  #e0e2e7;
  --red:    #ef4444;
  --red-light: #f87171;
  --green:  #10b981;
  --green-light: #34d399;
  --blue:   #3b82f6;
  --blue-light: #60a5fa;
  --purple: #8b5cf6;
  --orange: #f59e0b;
  --radius: 16px;
  --radius-sm: 10px;
  --shadow: 0 10px 40px rgba(0,0,0,0.4);
  --shadow-lg: 0 20px 60px rgba(0,0,0,0.5);
  --trans:  all 0.35s cubic-bezier(0.4,0,0.2,1);
  --trans-fast: all 0.2s cubic-bezier(0.4,0,0.2,1);
}

*,*::before,*::after { box-sizing:border-box; margin:0; padding:0 }
html { scroll-behavior:smooth; font-size: 16px }
body { 
  font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif; 
  background: var(--dark); 
  color: var(--white); 
  line-height: 1.6; 
  overflow-x: hidden;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}
a { text-decoration:none; color:inherit }
button { cursor:pointer; border:none; outline:none; font-family:inherit }
input,select,textarea { font-family:inherit; outline:none }
ul { list-style:none }
h1,h2,h3,h4 { font-family: 'Playfair Display', Georgia, serif; font-weight: 700 }

::-webkit-scrollbar { width:8px; height: 8px }
::-webkit-scrollbar-track { background:var(--dark) }
::-webkit-scrollbar-thumb { background:linear-gradient(to bottom, var(--gold), var(--gold-dark)); border-radius:4px }
::-webkit-scrollbar-thumb:hover { background:var(--gold2) }

/* ════════════════════════════════════
   ANIMATIONS
════════════════════════════════════ */
@keyframes fadeInUp {
  from { opacity: 0; transform: translateY(20px) }
  to { opacity: 1; transform: translateY(0) }
}
@keyframes fadeIn {
  from { opacity: 0 }
  to { opacity: 1 }
}
@keyframes slideInRight {
  from { transform: translateX(100%); opacity: 0 }
  to { transform: translateX(0); opacity: 1 }
}
@keyframes pulse {
  0%, 100% { opacity: 1 }
  50% { opacity: 0.6 }
}
@keyframes shimmer {
  0% { background-position: -1000px 0 }
  100% { background-position: 1000px 0 }
}

/* ════════════════════════════════════
   LAYOUT
════════════════════════════════════ */
.admin-layout {
  display: grid;
  grid-template-columns: 280px 1fr;
  min-height: 100vh;
}

/* ════════════════════════════════════
   SIDEBAR
════════════════════════════════════ */
.sidebar {
  background: linear-gradient(180deg, var(--black) 0%, var(--dark) 100%);
  border-right: 1px solid var(--border);
  position: sticky;
  top: 0;
  height: 100vh;
  overflow-y: auto;
  display: flex;
  flex-direction: column;
  box-shadow: 4px 0 24px rgba(0,0,0,0.3);
  z-index: 100;
}

.sidebar-logo {
  padding: 2rem 1.75rem;
  border-bottom: 1px solid var(--border);
  background: linear-gradient(135deg, rgba(212,175,55,0.1) 0%, rgba(212,175,55,0) 100%);
}
.sidebar-logo .brand {
  font-size: 1.75rem;
  background: linear-gradient(135deg, var(--gold) 0%, var(--gold2) 100%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
  letter-spacing: 0.2em;
  font-weight: 800;
  text-transform: uppercase;
  font-family: 'Playfair Display', serif;
  margin-bottom: 0.25rem;
}
.sidebar-logo .sub {
  font-size: 0.7rem;
  color: var(--gray);
  letter-spacing: 0.15em;
  text-transform: uppercase;
  font-weight: 500;
}

.sidebar-nav { 
  padding: 1.5rem 0; 
  flex: 1;
  animation: fadeIn 0.5s ease;
}

.nav-item {
  display: flex;
  align-items: center;
  gap: 1rem;
  padding: 1rem 1.75rem;
  font-size: 0.9rem;
  color: var(--gray);
  cursor: pointer;
  transition: var(--trans);
  border-left: 3px solid transparent;
  user-select: none;
  font-weight: 500;
  position: relative;
  overflow: hidden;
}
.nav-item::before {
  content: '';
  position: absolute;
  left: 0;
  top: 0;
  width: 0;
  height: 100%;
  background: linear-gradient(90deg, rgba(212,175,55,0.1) 0%, transparent 100%);
  transition: var(--trans);
}
.nav-item:hover::before { width: 100% }
.nav-item:hover  { 
  color: var(--white); 
  background: rgba(255,255,255,0.03);
  transform: translateX(4px);
}
.nav-item.active { 
  color: var(--gold);  
  background: linear-gradient(90deg, rgba(212,175,55,0.12) 0%, transparent 100%);
  border-left-color: var(--gold);
  font-weight: 600;
}
.nav-item.active .nav-icon {
  filter: drop-shadow(0 0 8px rgba(212,175,55,0.6));
}
.nav-icon { 
  font-size: 1.25rem; 
  width: 28px; 
  text-align: center; 
  flex-shrink: 0;
  transition: var(--trans);
}
.nav-item:hover .nav-icon {
  transform: scale(1.1);
}

.sidebar-footer {
  padding: 1.5rem 1.75rem;
  border-top: 1px solid var(--border);
  background: linear-gradient(180deg, transparent 0%, rgba(0,0,0,0.3) 100%);
}
.admin-user {
  display: flex;
  align-items: center;
  gap: 1rem;
  padding: 0.75rem;
  border-radius: var(--radius-sm);
  transition: var(--trans-fast);
  cursor: pointer;
}
.admin-user:hover {
  background: rgba(255,255,255,0.05);
}
.admin-avatar {
  width: 44px; 
  height: 44px;
  background: linear-gradient(135deg, var(--gold) 0%, var(--gold2) 100%);
  border-radius: 50%;
  display: flex; 
  align-items: center; 
  justify-content: center;
  font-size: 1.1rem; 
  color: var(--black); 
  font-weight: 800;
  box-shadow: 0 4px 12px rgba(212,175,55,0.4);
  position: relative;
}
.admin-avatar::after {
  content: '';
  position: absolute;
  width: 12px;
  height: 12px;
  background: var(--green);
  border: 3px solid var(--card);
  border-radius: 50%;
  bottom: -2px;
  right: -2px;
}
.admin-user-info .name  { 
  font-size: 0.9rem; 
  font-weight: 600;
  margin-bottom: 0.1rem;
}
.admin-user-info .role  { 
  font-size: 0.75rem; 
  color: var(--gold);
  font-weight: 500;
}

/* ════════════════════════════════════
   MAIN CONTENT
════════════════════════════════════ */
.main-content {
  background: var(--dark);
  padding: 2.5rem 3rem;
  overflow: auto;
  animation: fadeIn 0.4s ease;
}

/* Top bar */
.topbar {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 2.5rem;
  padding-bottom: 2rem;
  border-bottom: 1px solid var(--border);
  flex-wrap: wrap;
  gap: 1.5rem;
}
.topbar h1 { 
  font-size: 2rem;
  background: linear-gradient(135deg, var(--white) 0%, var(--gray-light) 100%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
  letter-spacing: -0.02em;
}
.topbar-right { display: flex; align-items: center; gap: 1rem; flex-wrap: wrap }
.topbar-search {
  display: flex;
  align-items: center;
  gap: 0.75rem;
  background: var(--card);
  border: 1px solid var(--border);
  border-radius: var(--radius-sm);
  padding: 0.65rem 1.25rem;
  transition: var(--trans-fast);
  min-width: 220px;
}
.topbar-search:focus-within {
  border-color: var(--gold);
  box-shadow: 0 0 0 3px rgba(212,175,55,0.1);
}
.topbar-search span {
  font-size: 1.1rem;
  opacity: 0.6;
}
.topbar-search input {
  background: none; 
  border: none;
  color: var(--white); 
  font-size: 0.9rem; 
  flex: 1;
  font-weight: 500;
}
.topbar-search input::placeholder { color: var(--gray); font-weight: 400 }
.back-btn {
  display: inline-flex; 
  align-items: center; 
  gap: 0.5rem;
  background: var(--card); 
  border: 1px solid var(--border);
  color: var(--light); 
  padding: 0.65rem 1.25rem;
  border-radius: var(--radius-sm); 
  font-size: 0.85rem;
  text-transform: uppercase; 
  letter-spacing: 0.08em;
  transition: var(--trans);
  font-weight: 600;
}
.back-btn:hover { 
  border-color: var(--gold); 
  color: var(--gold);
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(212,175,55,0.2);
}

/* Tabs */
.tab { 
  display: none;
  animation: fadeInUp 0.5s ease;
}
.tab.active { display: block }

/* ════════════════════════════════════
   STATS CARDS
════════════════════════════════════ */
.stats-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  gap: 1.75rem;
  margin-bottom: 2.5rem;
}
.stat-card {
  background: linear-gradient(135deg, var(--card) 0%, var(--dark2) 100%);
  border: 1px solid var(--border);
  border-radius: var(--radius);
  padding: 2rem;
  transition: var(--trans);
  position: relative;
  overflow: hidden;
  cursor: pointer;
}
.stat-card::before {
  content: '';
  position: absolute;
  top: 0; right: 0;
  width: 120px; height: 120px;
  background: radial-gradient(circle, rgba(212,175,55,0.08) 0%, transparent 70%);
  border-radius: 50%;
  transform: translate(30%, -30%);
}
.stat-card::after {
  content: '';
  position: absolute;
  inset: 0;
  background: linear-gradient(135deg, transparent 0%, rgba(212,175,55,0.03) 100%);
  opacity: 0;
  transition: var(--trans);
}
.stat-card:hover {
  border-color: var(--gold);
  transform: translateY(-4px);
  box-shadow: var(--shadow);
}
.stat-card:hover::after { opacity: 1 }
.stat-icon { 
  font-size: 2.25rem; 
  margin-bottom: 1rem;
  display: inline-block;
  filter: grayscale(0.3);
  transition: var(--trans);
}
.stat-card:hover .stat-icon {
  filter: grayscale(0);
  transform: scale(1.1);
}
.stat-value { 
  font-size: 2.5rem; 
  font-weight: 800; 
  background: linear-gradient(135deg, var(--gold) 0%, var(--gold2) 100%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
  line-height: 1.2;
  margin-bottom: 0.25rem;
}
.stat-label { 
  color: var(--gray); 
  font-size: 0.8rem; 
  text-transform: uppercase; 
  letter-spacing: 0.1em; 
  font-weight: 600;
}
.stat-change { 
  font-size: 0.8rem; 
  color: var(--green); 
  margin-top: 0.75rem;
  font-weight: 600;
  display: inline-flex;
  align-items: center;
  gap: 0.25rem;
  padding: 0.25rem 0.75rem;
  background: rgba(16,185,129,0.1);
  border-radius: 20px;
}
.stat-change.down { 
  color: var(--red);
  background: rgba(239,68,68,0.1);
}

/* ════════════════════════════════════
   SECTION BOXES
════════════════════════════════════ */
.section-box {
  background: var(--card);
  border: 1px solid var(--border);
  border-radius: var(--radius);
  overflow: hidden;
  margin-bottom: 2rem;
  box-shadow: 0 4px 16px rgba(0,0,0,0.2);
  transition: var(--trans);
}
.section-box:hover {
  box-shadow: 0 8px 24px rgba(0,0,0,0.3);
}
.section-head {
  padding: 1.5rem 2rem;
  display: flex;
  align-items: center;
  justify-content: space-between;
  border-bottom: 1px solid var(--border);
  flex-wrap: wrap;
  gap: 1rem;
  background: linear-gradient(180deg, rgba(255,255,255,0.02) 0%, transparent 100%);
}
.section-head h3 { 
  font-size: 1.1rem;
  font-weight: 700;
  letter-spacing: -0.01em;
}

/* ════════════════════════════════════
   DATA TABLE
════════════════════════════════════ */
.table-wrap { overflow-x: auto }
.data-table { width: 100%; border-collapse: collapse }
.data-table th {
  padding: 1.25rem 1.75rem;
  text-align: left;
  font-size: 0.75rem;
  letter-spacing: 0.12em;
  text-transform: uppercase;
  color: var(--gray);
  background: var(--dark2);
  border-bottom: 1px solid var(--border);
  white-space: nowrap;
  font-weight: 700;
}
.data-table td {
  padding: 1.5rem 1.75rem;
  font-size: 0.9rem;
  border-bottom: 1px solid var(--border);
  white-space: nowrap;
  font-weight: 500;
}
.data-table tr:last-child td { border-bottom: none }
.data-table tbody tr {
  transition: var(--trans-fast);
}
.data-table tbody tr:hover {
  background: var(--card-hover);
  transform: scale(1.001);
}
.text-gold { 
  color: var(--gold);
  font-weight: 600;
}
.text-gray { color: var(--gray) }

/* Status badges */
.badge {
  display: inline-block;
  padding: 0.35rem 0.9rem;
  border-radius: 50px;
  font-size: 0.7rem;
  font-weight: 700;
  letter-spacing: 0.08em;
  text-transform: uppercase;
  transition: var(--trans-fast);
}
.badge:hover {
  transform: scale(1.05);
}
.badge-pending    { background: linear-gradient(135deg, rgba(245,158,11,0.2) 0%, rgba(245,158,11,0.1) 100%); color: var(--orange); border: 1px solid rgba(245,158,11,0.3) }
.badge-processing { background: linear-gradient(135deg, rgba(59,130,246,0.2) 0%, rgba(59,130,246,0.1) 100%); color: var(--blue); border: 1px solid rgba(59,130,246,0.3) }
.badge-shipped    { background: linear-gradient(135deg, rgba(139,92,246,0.2) 0%, rgba(139,92,246,0.1) 100%); color: var(--purple); border: 1px solid rgba(139,92,246,0.3) }
.badge-delivered  { background: linear-gradient(135deg, rgba(16,185,129,0.2) 0%, rgba(16,185,129,0.1) 100%); color: var(--green); border: 1px solid rgba(16,185,129,0.3) }
.badge-cancelled  { background: linear-gradient(135deg, rgba(239,68,68,0.2) 0%, rgba(239,68,68,0.1) 100%); color: var(--red); border: 1px solid rgba(239,68,68,0.3) }
.badge-active     { background: linear-gradient(135deg, rgba(16,185,129,0.2) 0%, rgba(16,185,129,0.1) 100%); color: var(--green); border: 1px solid rgba(16,185,129,0.3) }
.badge-inactive   { background: linear-gradient(135deg, rgba(139,148,158,0.2) 0%, rgba(139,148,158,0.1) 100%); color: var(--gray); border: 1px solid rgba(139,148,158,0.3) }

/* Action buttons */
.action-btns { display: flex; gap: 0.6rem; flex-wrap: wrap }
.action-btn {
  padding: 0.45rem 1rem;
  border-radius: 8px;
  font-size: 0.75rem;
  font-weight: 700;
  letter-spacing: 0.06em;
  text-transform: uppercase;
  transition: var(--trans);
  border: 1px solid transparent;
}
.btn-view { 
  background: linear-gradient(135deg, rgba(59,130,246,0.15) 0%, rgba(59,130,246,0.08) 100%); 
  color: var(--blue);
  border-color: rgba(59,130,246,0.2);
}
.btn-view:hover { 
  background: rgba(59,130,246,0.25);
  border-color: var(--blue);
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(59,130,246,0.3);
}
.btn-edit { 
  background: linear-gradient(135deg, rgba(212,175,55,0.15) 0%, rgba(212,175,55,0.08) 100%); 
  color: var(--gold);
  border-color: rgba(212,175,55,0.2);
}
.btn-edit:hover { 
  background: rgba(212,175,55,0.25);
  border-color: var(--gold);
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(212,175,55,0.3);
}
.btn-del { 
  background: linear-gradient(135deg, rgba(239,68,68,0.15) 0%, rgba(239,68,68,0.08) 100%); 
  color: var(--red);
  border-color: rgba(239,68,68,0.2);
}
.btn-del:hover { 
  background: rgba(239,68,68,0.25);
  border-color: var(--red);
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(239,68,68,0.3);
}

/* ════════════════════════════════════
   BUTTONS
════════════════════════════════════ */
.btn {
  display: inline-flex; 
  align-items: center; 
  justify-content: center; 
  gap: 0.5rem;
  padding: 0.8rem 1.75rem;
  border-radius: var(--radius-sm);
  font-size: 0.85rem;
  letter-spacing: 0.1em;
  text-transform: uppercase;
  font-weight: 700;
  transition: var(--trans);
  font-family: inherit;
  cursor: pointer;
  border: 1px solid transparent;
  position: relative;
  overflow: hidden;
}
.btn::before {
  content: '';
  position: absolute;
  inset: 0;
  background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, transparent 100%);
  opacity: 0;
  transition: var(--trans);
}
.btn:hover::before { opacity: 1 }
.btn-gold { 
  background: linear-gradient(135deg, var(--gold) 0%, var(--gold-dark) 100%); 
  color: var(--black);
  box-shadow: 0 4px 12px rgba(212,175,55,0.3);
}
.btn-gold:hover { 
  transform: translateY(-2px);
  box-shadow: 0 6px 20px rgba(212,175,55,0.4);
}
.btn-outline { 
  background: transparent; 
  color: var(--white); 
  border: 1px solid var(--border);
}
.btn-outline:hover { 
  border-color: var(--gold); 
  color: var(--gold);
  background: rgba(212,175,55,0.05);
}
.btn-dark { 
  background: var(--dark2); 
  color: var(--white); 
  border: 1px solid var(--border);
}
.btn-dark:hover {
  background: var(--card);
  border-color: var(--border-light);
}
.btn-sm { 
  padding: 0.5rem 1.25rem; 
  font-size: 0.78rem;
}

/* ════════════════════════════════════
   FORM ELEMENTS
════════════════════════════════════ */
.form-grid { 
  display: grid; 
  grid-template-columns: 1fr 1fr; 
  gap: 1.5rem;
}
.form-grid.cols-1 { grid-template-columns: 1fr }
.form-grid.cols-3 { grid-template-columns: 1fr 1fr 1fr }
.full { grid-column: 1 / -1 }

.form-group { 
  display: flex; 
  flex-direction: column; 
  gap: 0.6rem;
}
.form-group label {
  font-size: 0.8rem;
  letter-spacing: 0.1em;
  text-transform: uppercase;
  color: var(--gray-light);
  font-weight: 600;
}
.form-group input,
.form-group select,
.form-group textarea {
  background: var(--dark2);
  border: 1px solid var(--border);
  color: var(--white);
  padding: 0.9rem 1.25rem;
  border-radius: var(--radius-sm);
  font-size: 0.9rem;
  transition: var(--trans-fast);
  font-weight: 500;
}
.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus { 
  border-color: var(--gold);
  background: var(--card);
  box-shadow: 0 0 0 3px rgba(212,175,55,0.1);
}
.form-group select option { 
  background: var(--dark2);
  padding: 0.5rem;
}
.form-group textarea { 
  resize: vertical; 
  min-height: 100px;
  font-family: inherit;
}
.form-group .err { 
  color: var(--red); 
  font-size: 0.78rem; 
  display: none;
  font-weight: 600;
}
.form-group.invalid input,
.form-group.invalid select { 
  border-color: var(--red);
  background: rgba(239,68,68,0.05);
}
.form-group.invalid .err { display: block }

/* ════════════════════════════════════
   CHART BARS
════════════════════════════════════ */
.chart-section { padding: 2rem }
.chart-bars {
  display: flex;
  align-items: flex-end;
  gap: 1rem;
  height: 180px;
  margin-bottom: 1rem;
}
.bar-col { 
  flex: 1; 
  display: flex; 
  flex-direction: column; 
  align-items: center; 
  gap: 0.6rem;
}
.bar {
  width: 100%;
  background: linear-gradient(to top, var(--gold-dark), var(--gold), var(--gold2));
  border-radius: 8px 8px 0 0;
  transition: var(--trans);
  min-height: 4px;
  position: relative;
  cursor: pointer;
  box-shadow: 0 -4px 12px rgba(212,175,55,0.3);
}
.bar::before {
  content: '';
  position: absolute;
  inset: 0;
  background: linear-gradient(to top, transparent, rgba(255,255,255,0.2));
  border-radius: 8px 8px 0 0;
  opacity: 0;
  transition: var(--trans);
}
.bar:hover::before { opacity: 1 }
.bar:hover { 
  transform: scaleY(1.05); 
  transform-origin: bottom;
  filter: brightness(1.2);
}
.bar-val { 
  font-size: 0.75rem; 
  color: var(--gold); 
  font-weight: 700;
}
.bar-label { 
  font-size: 0.72rem; 
  color: var(--gray); 
  text-align: center;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 0.05em;
}

.chart-alt {
  display: flex; 
  flex-direction: column; 
  gap: 1.25rem; 
  padding: 2rem;
}
.chart-row { 
  display: flex; 
  align-items: center; 
  gap: 1.25rem;
}
.chart-row-label { 
  width: 120px; 
  font-size: 0.85rem; 
  color: var(--gray-light); 
  flex-shrink: 0;
  font-weight: 600;
}
.chart-row-bar-wrap { 
  flex: 1; 
  background: var(--dark2); 
  border-radius: 50px; 
  height: 12px; 
  overflow: hidden;
  border: 1px solid var(--border);
}
.chart-row-bar { 
  height: 100%; 
  background: linear-gradient(90deg, var(--gold-dark), var(--gold), var(--gold2));
  border-radius: 50px; 
  transition: width 0.8s cubic-bezier(0.4,0,0.2,1);
  box-shadow: inset 0 1px 2px rgba(255,255,255,0.2);
  position: relative;
}
.chart-row-bar::after {
  content: '';
  position: absolute;
  inset: 0;
  background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
  animation: shimmer 2s infinite;
}
.chart-row-val { 
  width: 70px; 
  text-align: right; 
  font-size: 0.85rem; 
  color: var(--gold); 
  font-weight: 700;
}

/* ════════════════════════════════════
   MODAL
════════════════════════════════════ */
.modal-overlay {
  position: fixed; 
  inset: 0;
  background: rgba(0,0,0,0.85);
  backdrop-filter: blur(8px);
  z-index: 2000;
  display: flex; 
  align-items: center; 
  justify-content: center;
  padding: 2rem;
  opacity: 0; 
  pointer-events: none;
  transition: var(--trans);
}
.modal-overlay.open { 
  opacity: 1; 
  pointer-events: all;
}
.modal {
  background: var(--card);
  border: 1px solid var(--border);
  border-radius: var(--radius);
  padding: 2.5rem;
  width: 100%; 
  max-width: 580px;
  box-shadow: var(--shadow-lg);
  transform: scale(0.9) translateY(20px);
  transition: var(--trans);
  max-height: 90vh;
  overflow-y: auto;
}
.modal-overlay.open .modal { 
  transform: scale(1) translateY(0);
}
.modal-head {
  display: flex; 
  align-items: center; 
  justify-content: space-between;
  margin-bottom: 2rem;
  padding-bottom: 1.5rem;
  border-bottom: 1px solid var(--border);
}
.modal-head h3 { 
  font-size: 1.35rem;
  letter-spacing: -0.01em;
}
.modal-close {
  background: var(--dark2); 
  color: var(--gray); 
  font-size: 1.5rem;
  transition: var(--trans-fast); 
  width: 36px; 
  height: 36px;
  border-radius: 8px;
  display: flex;
  align-items: center;
  justify-content: center;
  border: 1px solid var(--border);
}
.modal-close:hover { 
  color: var(--white); 
  background: var(--border);
  border-color: var(--border-light);
  transform: rotate(90deg);
}

/* ════════════════════════════════════
   TOAST
════════════════════════════════════ */
.toast-wrap {
  position: fixed; 
  bottom: 2rem; 
  right: 2rem;
  z-index: 9999;
  display: flex; 
  flex-direction: column; 
  gap: 1rem;
}
.toast {
  background: var(--card);
  border: 1px solid var(--border);
  border-radius: var(--radius-sm);
  padding: 1.1rem 1.75rem;
  display: flex; 
  align-items: center; 
  gap: 1rem;
  min-width: 300px;
  box-shadow: var(--shadow);
  animation: slideInRight 0.4s cubic-bezier(0.4,0,0.2,1);
  backdrop-filter: blur(12px);
}
.toast.success { 
  border-left: 4px solid var(--green);
  background: linear-gradient(90deg, rgba(16,185,129,0.1) 0%, var(--card) 100%);
}
.toast.error { 
  border-left: 4px solid var(--red);
  background: linear-gradient(90deg, rgba(239,68,68,0.1) 0%, var(--card) 100%);
}
.toast.info { 
  border-left: 4px solid var(--gold);
  background: linear-gradient(90deg, rgba(212,175,55,0.1) 0%, var(--card) 100%);
}
.toast span:first-child {
  font-size: 1.25rem;
}
.toast span:last-child {
  font-weight: 600;
  font-size: 0.9rem;
}

/* ════════════════════════════════════
   MISC
════════════════════════════════════ */
.divider { 
  height: 1px; 
  background: linear-gradient(90deg, transparent, var(--border), transparent); 
  margin: 2rem 0;
}
.product-thumb {
  width: 52px; 
  height: 52px;
  background: linear-gradient(135deg, var(--dark2) 0%, var(--black) 100%);
  border: 1px solid var(--border);
  border-radius: var(--radius-sm);
  display: flex; 
  align-items: center; 
  justify-content: center;
  font-size: 1.5rem;
  transition: var(--trans-fast);
  cursor: pointer;
}
.product-thumb:hover {
  transform: scale(1.1);
  border-color: var(--gold);
  box-shadow: 0 4px 12px rgba(212,175,55,0.3);
}
.empty-state {
  text-align: center; 
  padding: 4rem 2rem;
  color: var(--gray);
}
.empty-state .icon { 
  font-size: 3.5rem; 
  margin-bottom: 1.25rem;
  opacity: 0.5;
}
.empty-state p {
  font-size: 1rem;
  font-weight: 500;
}

/* Loading skeleton */
.skeleton {
  background: linear-gradient(90deg, var(--dark2) 25%, var(--card) 50%, var(--dark2) 75%);
  background-size: 200% 100%;
  animation: shimmer 1.5s infinite;
  border-radius: 8px;
}

/* ════════════════════════════════════
   RESPONSIVE
════════════════════════════════════ */
@media (max-width: 1200px) {
  .stats-grid { grid-template-columns: repeat(2, 1fr) }
}
@media (max-width: 768px) {
  .admin-layout { grid-template-columns: 1fr }
  .sidebar { 
    display: none;
    position: fixed;
    z-index: 999;
    width: 280px;
  }
  .sidebar.mobile-open { display: flex }
  .stats-grid { grid-template-columns: 1fr }
  .form-grid { grid-template-columns: 1fr }
  .main-content { padding: 1.5rem 1.25rem }
  .topbar h1 { font-size: 1.5rem }
  .section-head { padding: 1.25rem 1.5rem }
  .data-table th,
  .data-table td { padding: 1rem 1.25rem }
  .modal { padding: 1.75rem }
}
@media (max-width: 480px) {
  .topbar-search { min-width: 100% }
  .toast { min-width: auto; width: calc(100vw - 4rem) }
}
</style>
</head>
<body>

<div class="admin-layout">

  <!-- ══════════════════════════════
       SIDEBAR
  ══════════════════════════════ -->
  <aside class="sidebar" id="sidebar">
    <div class="sidebar-logo">
      <div class="brand">LUXE</div>
      <div class="sub">Premium Dashboard</div>
    </div>

    <nav class="sidebar-nav">
      <div class="nav-item active" data-tab="dashboard">
        <span class="nav-icon">📊</span> Dashboard
      </div>
      <div class="nav-item" data-tab="products">
        <span class="nav-icon">📦</span> Products
      </div>
      <div class="nav-item" data-tab="orders">
        <span class="nav-icon">🛒</span> Orders
      </div>
      <div class="nav-item" data-tab="users">
        <span class="nav-icon">👥</span> Users
      </div>
      <div class="nav-item" data-tab="analytics">
        <span class="nav-icon">📈</span> Analytics
      </div>
      <div class="nav-item" data-tab="settings">
        <span class="nav-icon">⚙️</span> Settings
      </div>
    </nav>

    <div class="sidebar-footer">
      <div class="admin-user">
        <div class="admin-avatar">A</div>
        <div class="admin-user-info">
          <div class="name">Admin User</div>
          <div class="role">Super Admin</div>
        </div>
      </div>
    </div>
  </aside>

  <!-- ══════════════════════════════
       MAIN
  ══════════════════════════════ -->
  <main class="main-content">

    <!-- Top Bar -->
    <div class="topbar">
      <h1 id="page-title">Dashboard Overview</h1>
      <div class="topbar-right">
        <div class="topbar-search">
          <span>🔍</span>
          <input type="text" placeholder="Search anything..." id="global-search"/>
        </div>
        <a href="ecommerce.html" class="back-btn">🏠 Back to Store</a>
      </div>
    </div>

    <!-- ══════════════════ DASHBOARD TAB ══════════════════ -->
    <div class="tab active" id="tab-dashboard">

      <!-- Stats -->
      <div class="stats-grid">
        <div class="stat-card">
          <div class="stat-icon">📦</div>
          <div class="stat-value" id="stat-products">12</div>
          <div class="stat-label">Total Products</div>
          <div class="stat-change">↑ 8% this month</div>
        </div>
        <div class="stat-card">
          <div class="stat-icon">🛒</div>
          <div class="stat-value">48</div>
          <div class="stat-label">Total Orders</div>
          <div class="stat-change">↑ 15% this month</div>
        </div>
        <div class="stat-card">
          <div class="stat-icon">👥</div>
          <div class="stat-value">1,284</div>
          <div class="stat-label">Total Users</div>
          <div class="stat-change">↑ 22% this month</div>
        </div>
        <div class="stat-card">
          <div class="stat-icon">💰</div>
          <div class="stat-value">$84K</div>
          <div class="stat-label">Revenue</div>
          <div class="stat-change">↑ 31% this month</div>
        </div>
      </div>

      <!-- Charts Row -->
      <div style="display:grid;grid-template-columns:1fr 1fr;gap:2rem;margin-bottom:2rem">

        <!-- Monthly Revenue Bar Chart -->
        <div class="section-box">
          <div class="section-head">
            <h3>Monthly Revenue</h3>
            <span class="text-gray" style="font-size:0.8rem;font-weight:600">2025</span>
          </div>
          <div class="chart-section">
            <div class="chart-bars" id="revenue-chart"></div>
          </div>
        </div>

        <!-- Sales by Category -->
        <div class="section-box">
          <div class="section-head"><h3>Sales by Category</h3></div>
          <div class="chart-alt" id="category-chart"></div>
        </div>
      </div>

      <!-- Recent Orders -->
      <div class="section-box">
        <div class="section-head">
          <h3>Recent Orders</h3>
          <button class="btn btn-outline btn-sm" onclick="switchTab('orders')">View All →</button>
        </div>
        <div class="table-wrap">
          <table class="data-table">
            <thead>
              <tr>
                <th>Order ID</th><th>Customer</th><th>Amount</th>
                <th>Status</th><th>Date</th><th>Action</th>
              </tr>
            </thead>
            <tbody>
              <tr><td><span class="text-gold">#ORD-001</span></td><td>John Doe</td><td class="text-gold">$299.00</td><td><span class="badge badge-delivered">Delivered</span></td><td>Mar 05</td><td><button class="action-btn btn-view">View</button></td></tr>
              <tr><td><span class="text-gold">#ORD-002</span></td><td>Jane Smith</td><td class="text-gold">$799.00</td><td><span class="badge badge-shipped">Shipped</span></td><td>Mar 04</td><td><button class="action-btn btn-view">View</button></td></tr>
              <tr><td><span class="text-gold">#ORD-003</span></td><td>Mike Johnson</td><td class="text-gold">$149.00</td><td><span class="badge badge-processing">Processing</span></td><td>Mar 04</td><td><button class="action-btn btn-view">View</button></td></tr>
              <tr><td><span class="text-gold">#ORD-004</span></td><td>Sara Lee</td><td class="text-gold">$1,299.00</td><td><span class="badge badge-pending">Pending</span></td><td>Mar 03</td><td><button class="action-btn btn-view">View</button></td></tr>
            </tbody>
          </table>
        </div>
      </div>

    </div><!-- end dashboard tab -->

    <!-- ══════════════════ PRODUCTS TAB ══════════════════ -->
    <div class="tab" id="tab-products">
      <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:2rem;flex-wrap:wrap;gap:1.5rem">
        <div>
          <h2 style="font-size:1.25rem;margin-bottom:0.5rem;letter-spacing:-0.01em">Product Management</h2>
          <p class="text-gray" style="font-size:0.9rem;font-weight:500" id="product-count-label">Loading...</p>
        </div>
        <div style="display:flex;gap:1rem;flex-wrap:wrap">
          <select id="product-filter-cat" style="background:var(--card);border:1px solid var(--border);color:var(--white);padding:0.65rem 1.25rem;border-radius:var(--radius-sm);font-size:0.85rem;font-weight:600;cursor:pointer">
            <option value="">All Categories</option>
            <option>Electronics</option><option>Fashion</option>
            <option>Watches</option><option>Jewelry</option>
            <option>Home</option><option>Beauty</option>
          </select>
          <button class="btn btn-gold" onclick="openModal('modal-add-product')">+ Add Product</button>
        </div>
      </div>
      <div class="section-box">
        <div class="table-wrap">
          <table class="data-table">
            <thead>
              <tr><th></th><th>Name</th><th>Category</th><th>Price</th><th>Old Price</th><th>Rating</th><th>Reviews</th><th>Actions</th></tr>
            </thead>
            <tbody id="products-tbody"></tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- ══════════════════ ORDERS TAB ══════════════════ -->
    <div class="tab" id="tab-orders">
      <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:2rem;flex-wrap:wrap;gap:1.5rem">
        <div>
          <h2 style="font-size:1.25rem;margin-bottom:0.5rem;letter-spacing:-0.01em">Order Management</h2>
          <p class="text-gray" style="font-size:0.9rem;font-weight:500">Manage all customer orders</p>
        </div>
        <select id="order-status-filter" style="background:var(--card);border:1px solid var(--border);color:var(--white);padding:0.65rem 1.25rem;border-radius:var(--radius-sm);font-size:0.85rem;font-weight:600;cursor:pointer">
          <option value="">All Statuses</option>
          <option>Pending</option><option>Processing</option>
          <option>Shipped</option><option>Delivered</option><option>Cancelled</option>
        </select>
      </div>
      <div class="section-box">
        <div class="table-wrap">
          <table class="data-table">
            <thead>
              <tr><th>Order ID</th><th>Customer</th><th>Email</th><th>Items</th><th>Amount</th><th>Status</th><th>Date</th><th>Actions</th></tr>
            </thead>
            <tbody id="orders-tbody"></tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- ══════════════════ USERS TAB ══════════════════ -->
    <div class="tab" id="tab-users">
      <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:2rem;flex-wrap:wrap;gap:1.5rem">
        <div>
          <h2 style="font-size:1.25rem;margin-bottom:0.5rem;letter-spacing:-0.01em">User Management</h2>
          <p class="text-gray" style="font-size:0.9rem;font-weight:500" id="user-count-label">Loading...</p>
        </div>
        <button class="btn btn-gold" onclick="openModal('modal-add-user')">+ Add User</button>
      </div>
      <div class="section-box">
        <div class="table-wrap">
          <table class="data-table">
            <thead>
              <tr><th>Name</th><th>Email</th><th>Role</th><th>Orders</th><th>Total Spent</th><th>Joined</th><th>Status</th><th>Actions</th></tr>
            </thead>
            <tbody id="users-tbody"></tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- ══════════════════ ANALYTICS TAB ══════════════════ -->
    <div class="tab" id="tab-analytics">
      <div style="margin-bottom:2rem">
        <h2 style="font-size:1.25rem;margin-bottom:0.5rem;letter-spacing:-0.01em">Analytics & Reports</h2>
        <p class="text-gray" style="font-size:0.9rem;font-weight:500">Sales performance overview</p>
      </div>

      <div class="stats-grid" style="margin-bottom:2rem">
        <div class="stat-card">
          <div class="stat-icon">📊</div>
          <div class="stat-value">$84K</div>
          <div class="stat-label">Total Revenue</div>
          <div class="stat-change">↑ 31% vs last month</div>
        </div>
        <div class="stat-card">
          <div class="stat-icon">🛍️</div>
          <div class="stat-value">$312</div>
          <div class="stat-label">Avg. Order Value</div>
          <div class="stat-change">↑ 5% vs last month</div>
        </div>
        <div class="stat-card">
          <div class="stat-icon">🔄</div>
          <div class="stat-value">68%</div>
          <div class="stat-label">Return Customer Rate</div>
          <div class="stat-change">↑ 12% vs last month</div>
        </div>
        <div class="stat-card">
          <div class="stat-icon">🚚</div>
          <div class="stat-value">2.4d</div>
          <div class="stat-label">Avg. Delivery Time</div>
          <div class="stat-change down">↓ Improved by 0.3d</div>
        </div>
      </div>

      <div style="display:grid;grid-template-columns:1fr 1fr;gap:2rem">
        <div class="section-box">
          <div class="section-head"><h3>Weekly Sales</h3></div>
          <div class="chart-section">
            <div class="chart-bars" id="weekly-chart"></div>
          </div>
        </div>
        <div class="section-box">
          <div class="section-head"><h3>Top Products</h3></div>
          <div class="chart-alt" id="top-products-chart"></div>
        </div>
      </div>
    </div>

    <!-- ══════════════════ SETTINGS TAB ══════════════════ -->
    <div class="tab" id="tab-settings">
      <div style="margin-bottom:2rem">
        <h2 style="font-size:1.25rem;margin-bottom:0.5rem;letter-spacing:-0.01em">Store Settings</h2>
        <p class="text-gray" style="font-size:0.9rem;font-weight:500">Manage your store configuration</p>
      </div>

      <div style="display:grid;grid-template-columns:1fr 1fr;gap:2rem">
        <!-- General Settings -->
        <div class="section-box">
          <div class="section-head"><h3>General Settings</h3></div>
          <div style="padding:2rem">
            <div class="form-grid cols-1" style="gap:1.5rem">
              <div class="form-group">
                <label>Store Name</label>
                <input type="text" value="LUXE Premium Store"/>
              </div>
              <div class="form-group">
                <label>Store Email</label>
                <input type="email" value="support@luxe.com"/>
              </div>
              <div class="form-group">
                <label>Store Phone</label>
                <input type="tel" value="+1 (800) LUXE-123"/>
              </div>
              <div class="form-group">
                <label>Currency</label>
                <select><option>USD — US Dollar</option><option>EUR — Euro</option><option>GBP — British Pound</option></select>
              </div>
              <button class="btn btn-gold" onclick="showToast('Settings saved successfully!','success')">Save Changes</button>
            </div>
          </div>
        </div>

        <!-- Admin Account -->
        <div class="section-box">
          <div class="section-head"><h3>Admin Account</h3></div>
          <div style="padding:2rem">
            <div class="form-grid cols-1" style="gap:1.5rem">
              <div class="form-group">
                <label>Full Name</label>
                <input type="text" value="Admin User"/>
              </div>
              <div class="form-group">
                <label>Email</label>
                <input type="email" value="admin@luxe.com"/>
              </div>
              <div class="form-group">
                <label>New Password</label>
                <input type="password" placeholder="Leave blank to keep current"/>
              </div>
              <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" placeholder="Confirm new password"/>
              </div>
              <button class="btn btn-gold" onclick="showToast('Account updated successfully!','success')">Update Account</button>
            </div>
          </div>
        </div>

        <!-- Shipping -->
        <div class="section-box">
          <div class="section-head"><h3>Shipping Settings</h3></div>
          <div style="padding:2rem">
            <div class="form-grid cols-1" style="gap:1.5rem">
              <div class="form-group">
                <label>Free Shipping Threshold ($)</label>
                <input type="number" value="100"/>
              </div>
              <div class="form-group">
                <label>Standard Shipping Rate ($)</label>
                <input type="number" value="15"/>
              </div>
              <div class="form-group">
                <label>Express Shipping Rate ($)</label>
                <input type="number" value="35"/>
              </div>
              <button class="btn btn-gold" onclick="showToast('Shipping settings saved!','success')">Save Settings</button>
            </div>
          </div>
        </div>

        <!-- Tax Settings -->
        <div class="section-box">
          <div class="section-head"><h3>Tax Settings</h3></div>
          <div style="padding:2rem">
            <div class="form-grid cols-1" style="gap:1.5rem">
              <div class="form-group">
                <label>Tax Rate (%)</label>
                <input type="number" value="8" step="0.1"/>
              </div>
              <div class="form-group">
                <label>Tax Label</label>
                <input type="text" value="Sales Tax"/>
              </div>
              <div class="form-group">
                <label>Tax Included in Price?</label>
                <select><option>No — Add at checkout</option><option>Yes — Already included</option></select>
              </div>
              <button class="btn btn-gold" onclick="showToast('Tax settings saved!','success')">Save Settings</button>
            </div>
          </div>
        </div>
      </div>
    </div>

  </main>
</div>

<!-- ══════════════════════════════
     MODAL: ADD PRODUCT
══════════════════════════════ -->
<div class="modal-overlay" id="modal-add-product">
  <div class="modal">
    <div class="modal-head">
      <h3>Add New Product</h3>
      <button class="modal-close" onclick="closeModal('modal-add-product')">✕</button>
    </div>
    <form onsubmit="handleAddProduct(event)">
      <div class="form-grid" style="gap:1.5rem">
        <div class="form-group full">
          <label>Product Name *</label>
          <input type="text" id="ap-name" placeholder="e.g. Premium Gold Watch"/>
          <span class="err">Name is required</span>
        </div>
        <div class="form-group">
          <label>Price ($) *</label>
          <input type="number" id="ap-price" placeholder="299.00" step="0.01"/>
          <span class="err">Valid price required</span>
        </div>
        <div class="form-group">
          <label>Old Price ($)</label>
          <input type="number" id="ap-old" placeholder="399.00" step="0.01"/>
        </div>
        <div class="form-group">
          <label>Category *</label>
          <select id="ap-cat">
            <option value="">Select...</option>
            <option>Electronics</option><option>Fashion</option>
            <option>Watches</option><option>Jewelry</option>
            <option>Home</option><option>Beauty</option>
          </select>
          <span class="err">Category required</span>
        </div>
        <div class="form-group">
          <label>Icon / Emoji</label>
          <input type="text" id="ap-icon" placeholder="⌚" maxlength="4"/>
        </div>
        <div class="form-group full">
          <label>Description</label>
          <textarea id="ap-desc" placeholder="Describe this product..."></textarea>
        </div>
      </div>
      <div style="margin-top:2rem;display:flex;gap:1rem;justify-content:flex-end">
        <button type="button" class="btn btn-outline" onclick="closeModal('modal-add-product')">Cancel</button>
        <button type="submit" class="btn btn-gold">Add Product</button>
      </div>
    </form>
  </div>
</div>

<!-- ══════════════════════════════
     MODAL: EDIT PRODUCT
══════════════════════════════ -->
<div class="modal-overlay" id="modal-edit-product">
  <div class="modal">
    <div class="modal-head">
      <h3>Edit Product</h3>
      <button class="modal-close" onclick="closeModal('modal-edit-product')">✕</button>
    </div>
    <form onsubmit="handleEditProduct(event)">
      <input type="hidden" id="ep-id"/>
      <div class="form-grid" style="gap:1.5rem">
        <div class="form-group full">
          <label>Product Name *</label>
          <input type="text" id="ep-name"/>
        </div>
        <div class="form-group">
          <label>Price ($) *</label>
          <input type="number" id="ep-price" step="0.01"/>
        </div>
        <div class="form-group">
          <label>Old Price ($)</label>
          <input type="number" id="ep-old" step="0.01"/>
        </div>
        <div class="form-group">
          <label>Category</label>
          <select id="ep-cat">
            <option>Electronics</option><option>Fashion</option>
            <option>Watches</option><option>Jewelry</option>
            <option>Home</option><option>Beauty</option>
          </select>
        </div>
        <div class="form-group">
          <label>Icon / Emoji</label>
          <input type="text" id="ep-icon" maxlength="4"/>
        </div>
        <div class="form-group full">
          <label>Description</label>
          <textarea id="ep-desc"></textarea>
        </div>
      </div>
      <div style="margin-top:2rem;display:flex;gap:1rem;justify-content:flex-end">
        <button type="button" class="btn btn-outline" onclick="closeModal('modal-edit-product')">Cancel</button>
        <button type="submit" class="btn btn-gold">Save Changes</button>
      </div>
    </form>
  </div>
</div>

<!-- ══════════════════════════════
     MODAL: ADD USER
══════════════════════════════ -->
<div class="modal-overlay" id="modal-add-user">
  <div class="modal">
    <div class="modal-head">
      <h3>Add New User</h3>
      <button class="modal-close" onclick="closeModal('modal-add-user')">✕</button>
    </div>
    <form onsubmit="handleAddUser(event)">
      <div class="form-grid" style="gap:1.5rem">
        <div class="form-group">
          <label>First Name *</label>
          <input type="text" id="au-fname" placeholder="John"/>
        </div>
        <div class="form-group">
          <label>Last Name *</label>
          <input type="text" id="au-lname" placeholder="Doe"/>
        </div>
        <div class="form-group full">
          <label>Email *</label>
          <input type="email" id="au-email" placeholder="john@email.com"/>
        </div>
        <div class="form-group">
          <label>Role</label>
          <select id="au-role">
            <option>Customer</option>
            <option>Editor</option>
            <option>Admin</option>
          </select>
        </div>
        <div class="form-group">
          <label>Status</label>
          <select id="au-status">
            <option>Active</option>
            <option>Inactive</option>
          </select>
        </div>
      </div>
      <div style="margin-top:2rem;display:flex;gap:1rem;justify-content:flex-end">
        <button type="button" class="btn btn-outline" onclick="closeModal('modal-add-user')">Cancel</button>
        <button type="submit" class="btn btn-gold">Add User</button>
      </div>
    </form>
  </div>
</div>

<!-- ══════════════════════════════
     MODAL: VIEW ORDER
══════════════════════════════ -->
<div class="modal-overlay" id="modal-view-order">
  <div class="modal">
    <div class="modal-head">
      <h3>Order Details</h3>
      <button class="modal-close" onclick="closeModal('modal-view-order')">✕</button>
    </div>
    <div id="order-detail-content"></div>
  </div>
</div>

<!-- Toast Container -->
<div class="toast-wrap" id="toast-wrap"></div>

<script>
/* ═══════════════════════════════════════
   DATA (SAME AS BEFORE - NO CHANGES)
═══════════════════════════════════════ */
var products = [
  {id:1,  name:'Luminara Gold Watch',    cat:'Watches',     price:1299, old:1799, rating:4.9, reviews:284, icon:'⌚'},
  {id:2,  name:'AirPods Pro Max',        cat:'Electronics', price:549,  old:649,  rating:4.8, reviews:1203,icon:'🎧'},
  {id:3,  name:'Diamond Solitaire Ring', cat:'Jewelry',     price:2499, old:null, rating:5.0, reviews:89,  icon:'💍'},
  {id:4,  name:'Silk Evening Dress',     cat:'Fashion',     price:349,  old:499,  rating:4.7, reviews:156, icon:'👗'},
  {id:5,  name:'Smart Home Hub Pro',     cat:'Electronics', price:299,  old:399,  rating:4.6, reviews:412, icon:'🏠'},
  {id:6,  name:'Rose Gold Necklace',     cat:'Jewelry',     price:799,  old:null, rating:4.8, reviews:203, icon:'📿'},
  {id:7,  name:'Leather Tote Bag',       cat:'Fashion',     price:459,  old:599,  rating:4.5, reviews:318, icon:'👜'},
  {id:8,  name:'Espresso Machine',       cat:'Home',        price:699,  old:899,  rating:4.7, reviews:521, icon:'☕'},
  {id:9,  name:'Vitamin C Serum',        cat:'Beauty',      price:89,   old:119,  rating:4.8, reviews:944, icon:'✨'},
  {id:10, name:'Carbon Fiber Sunglasses',cat:'Fashion',     price:289,  old:null, rating:4.6, reviews:167, icon:'🕶️'},
  {id:11, name:'Smart Fitness Ring',     cat:'Electronics', price:349,  old:449,  rating:4.4, reviews:289, icon:'💪'},
  {id:12, name:'Cashmere Scarf',         cat:'Fashion',     price:199,  old:279,  rating:4.9, reviews:412, icon:'🧣'},
];

var orders = [
  {id:'#ORD-001', customer:'John Doe',      email:'john@email.com',  items:3, amount:299,  status:'Delivered', date:'Mar 05, 2025'},
  {id:'#ORD-002', customer:'Jane Smith',    email:'jane@email.com',  items:1, amount:799,  status:'Shipped',   date:'Mar 04, 2025'},
  {id:'#ORD-003', customer:'Mike Johnson',  email:'mike@email.com',  items:2, amount:149,  status:'Processing',date:'Mar 04, 2025'},
  {id:'#ORD-004', customer:'Sara Lee',      email:'sara@email.com',  items:1, amount:1299, status:'Pending',   date:'Mar 03, 2025'},
  {id:'#ORD-005', customer:'Tom Brown',     email:'tom@email.com',   items:4, amount:450,  status:'Cancelled', date:'Mar 02, 2025'},
  {id:'#ORD-006', customer:'Alice Wang',    email:'alice@email.com', items:2, amount:888,  status:'Delivered', date:'Mar 01, 2025'},
  {id:'#ORD-007', customer:'Bob Martinez',  email:'bob@email.com',   items:1, amount:349,  status:'Shipped',   date:'Feb 28, 2025'},
];

var users = [
  {id:1, name:'John Doe',     email:'john@email.com',  role:'Customer', orders:12, spent:2450, joined:'Jan 2025', status:'Active'},
  {id:2, name:'Jane Smith',   email:'jane@email.com',  role:'Customer', orders:7,  spent:1299, joined:'Feb 2025', status:'Active'},
  {id:3, name:'Mike Johnson', email:'mike@email.com',  role:'Customer', orders:3,  spent:588,  joined:'Feb 2025', status:'Active'},
  {id:4, name:'Sara Lee',     email:'sara@email.com',  role:'Editor',   orders:1,  spent:1299, joined:'Mar 2025', status:'Active'},
  {id:5, name:'Tom Brown',    email:'tom@email.com',   role:'Customer', orders:5,  spent:890,  joined:'Jan 2025', status:'Inactive'},
];

/* ═══════════════════════════════════════
   TAB SWITCHING (SAME)
═══════════════════════════════════════ */
var tabTitles = {
  dashboard:'Dashboard Overview',
  products: 'Product Management',
  orders:   'Order Management',
  users:    'User Management',
  analytics:'Analytics & Reports',
  settings: 'Store Settings'
};

function switchTab(name) {
  document.querySelectorAll('.tab').forEach(function(t){ t.classList.remove('active') });
  var tab = document.getElementById('tab-' + name);
  if (tab) tab.classList.add('active');

  document.querySelectorAll('.nav-item').forEach(function(n){ n.classList.remove('active') });
  var navItem = document.querySelector('.nav-item[data-tab="' + name + '"]');
  if (navItem) navItem.classList.add('active');

  document.getElementById('page-title').textContent = tabTitles[name] || name;

  if (name === 'products') renderProducts();
  if (name === 'orders')   renderOrders();
  if (name === 'users')    renderUsers();
  if (name === 'analytics') renderAnalyticsCharts();
}

/* ═══════════════════════════════════════
   RENDER PRODUCTS TABLE (SAME)
═══════════════════════════════════════ */
function renderProducts() {
  var filterCat = document.getElementById('product-filter-cat') ? document.getElementById('product-filter-cat').value : '';
  var filtered  = filterCat ? products.filter(function(p){ return p.cat === filterCat }) : products;

  document.getElementById('product-count-label').textContent = filtered.length + ' of ' + products.length + ' products';
  document.getElementById('stat-products').textContent = products.length;

  document.getElementById('products-tbody').innerHTML = filtered.map(function(p){
    return '<tr>' +
      '<td><div class="product-thumb">' + p.icon + '</div></td>' +
      '<td>' + p.name + '</td>' +
      '<td><span style="color:var(--gold);font-size:0.8rem">' + p.cat + '</span></td>' +
      '<td class="text-gold">$' + p.price.toLocaleString() + '</td>' +
      '<td class="text-gray">' + (p.old ? '$' + p.old.toLocaleString() : '—') + '</td>' +
      '<td>★ ' + p.rating + '</td>' +
      '<td>' + p.reviews + '</td>' +
      '<td><div class="action-btns">' +
        '<button class="action-btn btn-edit" onclick="openEditProduct(' + p.id + ')">Edit</button>' +
        '<button class="action-btn btn-del"  onclick="deleteProduct(' + p.id + ')">Delete</button>' +
      '</div></td>' +
    '</tr>';
  }).join('');
}

/* ═══════════════════════════════════════
   RENDER ORDERS TABLE (SAME)
═══════════════════════════════════════ */
function renderOrders() {
  var filterStatus = document.getElementById('order-status-filter') ? document.getElementById('order-status-filter').value : '';
  var filtered = filterStatus ? orders.filter(function(o){ return o.status === filterStatus }) : orders;

  document.getElementById('orders-tbody').innerHTML = filtered.map(function(o){
    var cls = 'badge-' + o.status.toLowerCase();
    return '<tr>' +
      '<td><span class="text-gold">' + o.id + '</span></td>' +
      '<td>' + o.customer + '</td>' +
      '<td class="text-gray">' + o.email + '</td>' +
      '<td>' + o.items + ' item' + (o.items > 1 ? 's' : '') + '</td>' +
      '<td class="text-gold">$' + o.amount.toLocaleString() + '</td>' +
      '<td><span class="badge ' + cls + '">' + o.status + '</span></td>' +
      '<td class="text-gray">' + o.date + '</td>' +
      '<td><div class="action-btns">' +
        '<button class="action-btn btn-view" onclick="viewOrder(\'' + o.id + '\')">View</button>' +
        '<button class="action-btn btn-del"  onclick="deleteOrder(\'' + o.id + '\')">Delete</button>' +
      '</div></td>' +
    '</tr>';
  }).join('');
}

/* ═══════════════════════════════════════
   RENDER USERS TABLE (SAME)
═══════════════════════════════════════ */
function renderUsers() {
  document.getElementById('user-count-label').textContent = users.length + ' registered users';
  document.getElementById('users-tbody').innerHTML = users.map(function(u){
    var sc = u.status === 'Active' ? 'badge-active' : 'badge-inactive';
    return '<tr>' +
      '<td>' + u.name + '</td>' +
      '<td class="text-gray">' + u.email + '</td>' +
      '<td><span style="font-size:0.78rem;color:var(--blue)">' + u.role + '</span></td>' +
      '<td>' + u.orders + '</td>' +
      '<td class="text-gold">$' + u.spent.toLocaleString() + '</td>' +
      '<td class="text-gray">' + u.joined + '</td>' +
      '<td><span class="badge ' + sc + '">' + u.status + '</span></td>' +
      '<td><div class="action-btns">' +
        '<button class="action-btn btn-edit" onclick="showToast(\'Edit: ' + u.name + '\',\'info\')">Edit</button>' +
        '<button class="action-btn btn-del"  onclick="deleteUser(' + u.id + ')">Delete</button>' +
      '</div></td>' +
    '</tr>';
  }).join('');
}

/* ═══════════════════════════════════════
   CHARTS (SAME)
═══════════════════════════════════════ */
function renderDashboardCharts() {
  var months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug'];
  var vals   = [42,58,71,63,89,74,95,84];
  var max    = Math.max.apply(null, vals);
  document.getElementById('revenue-chart').innerHTML = months.map(function(m,i){
    var h = Math.round((vals[i] / max) * 140);
    return '<div class="bar-col">' +
      '<div class="bar-val">$' + vals[i] + 'K</div>' +
      '<div class="bar" style="height:' + h + 'px"></div>' +
      '<div class="bar-label">' + m + '</div>' +
    '</div>';
  }).join('');

  var cats = [
    {name:'Electronics', val:35},
    {name:'Jewelry',     val:25},
    {name:'Fashion',     val:20},
    {name:'Watches',     val:12},
    {name:'Home',        val:5},
    {name:'Beauty',      val:3},
  ];
  document.getElementById('category-chart').innerHTML = cats.map(function(c){
    return '<div class="chart-row">' +
      '<div class="chart-row-label">' + c.name + '</div>' +
      '<div class="chart-row-bar-wrap"><div class="chart-row-bar" style="width:' + c.val + '%"></div></div>' +
      '<div class="chart-row-val">' + c.val + '%</div>' +
    '</div>';
  }).join('');
}

function renderAnalyticsCharts() {
  var days = ['Mon','Tue','Wed','Thu','Fri','Sat','Sun'];
  var vals = [18,24,15,32,28,41,35];
  var max  = Math.max.apply(null, vals);
  var el   = document.getElementById('weekly-chart');
  if (el) {
    el.innerHTML = days.map(function(d,i){
      var h = Math.round((vals[i] / max) * 130);
      return '<div class="bar-col">' +
        '<div class="bar-val">$' + vals[i] + 'K</div>' +
        '<div class="bar" style="height:' + h + 'px"></div>' +
        '<div class="bar-label">' + d + '</div>' +
      '</div>';
    }).join('');
  }

  var top = [
    {name:'Gold Watch',  pct:28},
    {name:'AirPods Max', pct:22},
    {name:'Diamond Ring',pct:18},
    {name:'Tote Bag',    pct:14},
    {name:'Espresso',    pct:10},
  ];
  var tp = document.getElementById('top-products-chart');
  if (tp) {
    tp.innerHTML = top.map(function(p){
      return '<div class="chart-row">' +
        '<div class="chart-row-label">' + p.name + '</div>' +
        '<div class="chart-row-bar-wrap"><div class="chart-row-bar" style="width:' + p.pct + '%"></div></div>' +
        '<div class="chart-row-val">' + p.pct + '%</div>' +
      '</div>';
    }).join('');
  }
}

/* ═══════════════════════════════════════
   PRODUCT CRUD (SAME)
═══════════════════════════════════════ */
function handleAddProduct(e) {
  e.preventDefault();
  var name  = document.getElementById('ap-name').value.trim();
  var price = parseFloat(document.getElementById('ap-price').value);
  var cat   = document.getElementById('ap-cat').value;
  var old   = parseFloat(document.getElementById('ap-old').value) || null;
  var icon  = document.getElementById('ap-icon').value || '📦';
  var desc  = document.getElementById('ap-desc').value;

  if (!name || !price || !cat) {
    showToast('Please fill in required fields', 'error');
    return;
  }

  products.push({
    id: Date.now(), name: name, cat: cat,
    price: price, old: old,
    rating: 0, reviews: 0, icon: icon, desc: desc
  });

  closeModal('modal-add-product');
  renderProducts();
  showToast(name + ' added successfully!', 'success');

  ['ap-name','ap-price','ap-old','ap-icon','ap-desc'].forEach(function(id){
    document.getElementById(id).value = '';
  });
  document.getElementById('ap-cat').value = '';
}

function openEditProduct(id) {
  var p = products.find(function(p){ return p.id === id });
  if (!p) return;
  document.getElementById('ep-id').value    = p.id;
  document.getElementById('ep-name').value  = p.name;
  document.getElementById('ep-price').value = p.price;
  document.getElementById('ep-old').value   = p.old || '';
  document.getElementById('ep-cat').value   = p.cat;
  document.getElementById('ep-icon').value  = p.icon;
  document.getElementById('ep-desc').value  = p.desc || '';
  openModal('modal-edit-product');
}

function handleEditProduct(e) {
  e.preventDefault();
  var id = parseInt(document.getElementById('ep-id').value);
  var p  = products.find(function(p){ return p.id === id });
  if (!p) return;

  p.name  = document.getElementById('ep-name').value.trim();
  p.price = parseFloat(document.getElementById('ep-price').value);
  p.old   = parseFloat(document.getElementById('ep-old').value) || null;
  p.cat   = document.getElementById('ep-cat').value;
  p.icon  = document.getElementById('ep-icon').value || p.icon;
  p.desc  = document.getElementById('ep-desc').value;

  closeModal('modal-edit-product');
  renderProducts();
  showToast(p.name + ' updated!', 'success');
}

function deleteProduct(id) {
  var idx = products.findIndex(function(p){ return p.id === id });
  if (idx > -1) {
    var name = products[idx].name;
    products.splice(idx, 1);
    renderProducts();
    showToast(name + ' deleted', 'error');
  }
}

/* ═══════════════════════════════════════
   ORDER CRUD (SAME)
═══════════════════════════════════════ */
function viewOrder(id) {
  var o = orders.find(function(o){ return o.id === id });
  if (!o) return;
  var cls = 'badge-' + o.status.toLowerCase();
  document.getElementById('order-detail-content').innerHTML =
    '<div style="display:grid;gap:1.5rem">' +
    '<div style="display:grid;grid-template-columns:1fr 1fr;gap:1.5rem">' +
      '<div><div class="text-gray" style="font-size:0.78rem;text-transform:uppercase;letter-spacing:0.08em;margin-bottom:0.5rem">Order ID</div><div style="font-weight:700;color:var(--gold)">' + o.id + '</div></div>' +
      '<div><div class="text-gray" style="font-size:0.78rem;text-transform:uppercase;letter-spacing:0.08em;margin-bottom:0.5rem">Status</div><div><span class="badge ' + cls + '">' + o.status + '</span></div></div>' +
      '<div><div class="text-gray" style="font-size:0.78rem;text-transform:uppercase;letter-spacing:0.08em;margin-bottom:0.5rem">Customer</div><div>' + o.customer + '</div></div>' +
      '<div><div class="text-gray" style="font-size:0.78rem;text-transform:uppercase;letter-spacing:0.08em;margin-bottom:0.5rem">Email</div><div class="text-gray">' + o.email + '</div></div>' +
      '<div><div class="text-gray" style="font-size:0.78rem;text-transform:uppercase;letter-spacing:0.08em;margin-bottom:0.5rem">Items</div><div>' + o.items + ' item(s)</div></div>' +
      '<div><div class="text-gray" style="font-size:0.78rem;text-transform:uppercase;letter-spacing:0.08em;margin-bottom:0.5rem">Total</div><div class="text-gold" style="font-size:1.25rem;font-weight:700">$' + o.amount.toLocaleString() + '</div></div>' +
      '<div><div class="text-gray" style="font-size:0.78rem;text-transform:uppercase;letter-spacing:0.08em;margin-bottom:0.5rem">Date</div><div>' + o.date + '</div></div>' +
    '</div>' +
    '<div style="margin-top:1rem">' +
      '<div class="text-gray" style="font-size:0.78rem;text-transform:uppercase;letter-spacing:0.08em;margin-bottom:1rem">Update Status</div>' +
      '<div style="display:flex;gap:0.75rem;flex-wrap:wrap">' +
        ['Pending','Processing','Shipped','Delivered','Cancelled'].map(function(s){
          return '<button class="action-btn ' + (o.status===s?'btn-edit':'btn-view') + '" onclick="updateOrderStatus(\'' + o.id + '\',\'' + s + '\')">' + s + '</button>';
        }).join('') +
      '</div>' +
    '</div>' +
    '</div>';
  openModal('modal-view-order');
}

function updateOrderStatus(id, status) {
  var o = orders.find(function(o){ return o.id === id });
  if (o) {
    o.status = status;
    closeModal('modal-view-order');
    renderOrders();
    showToast('Order ' + id + ' → ' + status, 'success');
  }
}

function deleteOrder(id) {
  var idx = orders.findIndex(function(o){ return o.id === id });
  if (idx > -1) {
    orders.splice(idx, 1);
    renderOrders();
    showToast('Order ' + id + ' deleted', 'error');
  }
}

/* ═══════════════════════════════════════
   USER CRUD (SAME)
═══════════════════════════════════════ */
function handleAddUser(e) {
  e.preventDefault();
  var fname  = document.getElementById('au-fname').value.trim();
  var lname  = document.getElementById('au-lname').value.trim();
  var email  = document.getElementById('au-email').value.trim();
  var role   = document.getElementById('au-role').value;
  var status = document.getElementById('au-status').value;

  if (!fname || !lname || !email) {
    showToast('Please fill in all required fields', 'error');
    return;
  }

  users.push({
    id: Date.now(), name: fname + ' ' + lname,
    email: email, role: role,
    orders: 0, spent: 0,
    joined: 'Mar 2025', status: status
  });

  closeModal('modal-add-user');
  renderUsers();
  showToast(fname + ' ' + lname + ' added!', 'success');

  ['au-fname','au-lname','au-email'].forEach(function(id){
    document.getElementById(id).value = '';
  });
}

function deleteUser(id) {
  var idx = users.findIndex(function(u){ return u.id === id });
  if (idx > -1) {
    var name = users[idx].name;
    users.splice(idx, 1);
    renderUsers();
    showToast(name + ' deleted', 'error');
  }
}

/* ═══════════════════════════════════════
   MODAL HELPERS (SAME)
═══════════════════════════════════════ */
function openModal(id) {
  document.getElementById(id).classList.add('open');
}
function closeModal(id) {
  document.getElementById(id).classList.remove('open');
}
document.querySelectorAll('.modal-overlay').forEach(function(el){
  el.addEventListener('click', function(e){
    if (e.target === this) this.classList.remove('open');
  });
});

/* ═══════════════════════════════════════
   TOAST (SAME)
═══════════════════════════════════════ */
function showToast(msg, type) {
  type = type || 'info';
  var icons = {success:'✅', error:'❌', info:'ℹ️'};
  var wrap  = document.getElementById('toast-wrap');
  var el    = document.createElement('div');
  el.className = 'toast ' + type;
  el.innerHTML = '<span>' + icons[type] + '</span><span>' + msg + '</span>';
  wrap.appendChild(el);
  setTimeout(function(){
    el.style.animation = 'slideInRight 0.3s ease reverse';
    setTimeout(function(){ el.remove() }, 280);
  }, 3500);
}

/* ═══════════════════════════════════════
   FILTER LISTENERS (SAME)
═══════════════════════════════════════ */
document.getElementById('product-filter-cat').addEventListener('change', renderProducts);
document.getElementById('order-status-filter').addEventListener('change', renderOrders);

/* ═══════════════════════════════════════
   INIT (SAME)
═══════════════════════════════════════ */
document.addEventListener('DOMContentLoaded', function() {
  document.querySelectorAll('.nav-item[data-tab]').forEach(function(el){
    el.addEventListener('click', function(){
      switchTab(this.getAttribute('data-tab'));
    });
  });

  renderDashboardCharts();
  setTimeout(renderDashboardCharts, 100);
});
</script>
</body>
</html>