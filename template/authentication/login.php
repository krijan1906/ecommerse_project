<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>LUXE — Admin Login</title>
<style>
/* ══════════════════════════════
   VARIABLES & RESET
══════════════════════════════ */
:root {
  --black:  #0a0a0a;
  --dark:   #111318;
  --dark2:  #1a1d24;
  --card:   #1e2128;
  --border: #2a2d36;
  --gold:   #c9a84c;
  --gold2:  #e8c96a;
  --white:  #f5f3ee;
  --gray:   #8a8d96;
  --light:  #d0cec9;
  --red:    #e05252;
  --green:  #4caf7d;
  --trans:  all 0.3s ease;
}
*,*::before,*::after { box-sizing:border-box; margin:0; padding:0 }
html { scroll-behavior:smooth }
body {
  font-family: 'Georgia', serif;
  background: var(--dark);
  color: var(--white);
  min-height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 1.5rem;
  position: relative;
  overflow: hidden;
}

/* Background decorations */
body::before {
  content: '';
  position: fixed;
  top: -200px; left: -200px;
  width: 600px; height: 600px;
  background: radial-gradient(circle, rgba(201,168,76,0.08), transparent 70%);
  border-radius: 50%;
  pointer-events: none;
}
body::after {
  content: '';
  position: fixed;
  bottom: -150px; right: -150px;
  width: 500px; height: 500px;
  background: radial-gradient(circle, rgba(201,168,76,0.06), transparent 70%);
  border-radius: 50%;
  pointer-events: none;
}

::-webkit-scrollbar { width: 6px }
::-webkit-scrollbar-track { background: var(--dark) }
::-webkit-scrollbar-thumb { background: var(--gold); border-radius: 3px }

/* ══════════════════════════════
   PAGE TOGGLE
══════════════════════════════ */
.auth-page { display: none; width: 100%; max-width: 440px; }
.auth-page.active { display: block; animation: fadeUp 0.4s ease }
@keyframes fadeUp {
  from { opacity: 0; transform: translateY(20px) }
  to   { opacity: 1; transform: translateY(0) }
}

/* ══════════════════════════════
   CARD
══════════════════════════════ */
.auth-card {
  background: var(--card);
  border: 1px solid var(--border);
  border-radius: 20px;
  padding: 2.5rem;
  box-shadow: 0 20px 60px rgba(0,0,0,0.5);
  position: relative;
  overflow: hidden;
}
.auth-card::before {
  content: '';
  position: absolute;
  top: 0; left: 0; right: 0;
  height: 3px;
  background: linear-gradient(90deg, var(--gold), var(--gold2), var(--gold));
}

/* Logo */
.auth-logo {
  text-align: center;
  margin-bottom: 0.4rem;
}
.auth-logo .brand {
  font-size: 2rem;
  font-weight: 700;
  letter-spacing: 0.2em;
  text-transform: uppercase;
  color: var(--gold);
}
.auth-logo .badge {
  display: inline-block;
  background: rgba(201,168,76,0.15);
  border: 1px solid rgba(201,168,76,0.3);
  color: var(--gold);
  font-size: 0.7rem;
  letter-spacing: 0.15em;
  text-transform: uppercase;
  padding: 0.25rem 0.85rem;
  border-radius: 50px;
  margin-top: 0.4rem;
}
.auth-subtitle {
  text-align: center;
  color: var(--gray);
  font-size: 0.88rem;
  margin: 1rem 0 2rem;
}

/* ══════════════════════════════
   FORM ELEMENTS
══════════════════════════════ */
.form-group {
  display: flex;
  flex-direction: column;
  gap: 0.4rem;
  margin-bottom: 1.1rem;
}
.form-group label {
  font-size: 0.78rem;
  letter-spacing: 0.1em;
  text-transform: uppercase;
  color: var(--gray);
}
.input-wrap {
  position: relative;
  display: flex;
  align-items: center;
}
.input-icon {
  position: absolute;
  left: 0.9rem;
  font-size: 1rem;
  pointer-events: none;
  z-index: 1;
}
.input-wrap input {
  width: 100%;
  background: var(--dark2);
  border: 1px solid var(--border);
  color: var(--white);
  padding: 0.8rem 1rem 0.8rem 2.6rem;
  border-radius: 10px;
  font-size: 0.9rem;
  font-family: 'Georgia', serif;
  transition: var(--trans);
}
.input-wrap input:focus {
  border-color: var(--gold);
  outline: none;
  background: var(--dark);
  box-shadow: 0 0 0 3px rgba(201,168,76,0.1);
}
.input-wrap input::placeholder { color: var(--gray) }
.toggle-pass {
  position: absolute;
  right: 0.9rem;
  background: none;
  border: none;
  color: var(--gray);
  cursor: pointer;
  font-size: 1rem;
  padding: 0;
  transition: var(--trans);
}
.toggle-pass:hover { color: var(--gold) }

/* Error message */
.error-msg {
  font-size: 0.76rem;
  color: var(--red);
  display: none;
  margin-top: 0.25rem;
}
.form-group.invalid input { border-color: var(--red) }
.form-group.invalid .error-msg { display: block }
.form-group.valid input { border-color: var(--green) }

/* Alert box */
.alert {
  padding: 0.85rem 1rem;
  border-radius: 8px;
  font-size: 0.85rem;
  margin-bottom: 1.2rem;
  display: none;
  align-items: center;
  gap: 0.6rem;
}
.alert.show { display: flex }
.alert-error {
  background: rgba(224,82,82,0.12);
  border: 1px solid rgba(224,82,82,0.3);
  color: var(--red);
}
.alert-success {
  background: rgba(76,175,77,0.12);
  border: 1px solid rgba(76,175,77,0.3);
  color: var(--green);
}

/* ══════════════════════════════
   BUTTONS
══════════════════════════════ */
.btn-submit {
  width: 100%;
  background: var(--gold);
  color: var(--black);
  border: none;
  padding: 0.9rem;
  border-radius: 10px;
  font-size: 0.88rem;
  font-weight: 700;
  letter-spacing: 0.1em;
  text-transform: uppercase;
  font-family: 'Georgia', serif;
  cursor: pointer;
  transition: var(--trans);
  margin-top: 0.5rem;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 0.5rem;
}
.btn-submit:hover {
  background: var(--gold2);
  transform: translateY(-2px);
  box-shadow: 0 6px 20px rgba(201,168,76,0.35);
}
.btn-submit:active { transform: translateY(0) }
.btn-submit:disabled {
  opacity: 0.6;
  cursor: not-allowed;
  transform: none;
}

/* ══════════════════════════════
   DIVIDER
══════════════════════════════ */
.divider {
  display: flex;
  align-items: center;
  gap: 0.75rem;
  margin: 1.2rem 0;
  color: var(--gray);
  font-size: 0.8rem;
}
.divider::before,
.divider::after {
  content: '';
  flex: 1;
  height: 1px;
  background: var(--border);
}

/* ══════════════════════════════
   FOOTER LINK
══════════════════════════════ */
.auth-switch {
  text-align: center;
  margin-top: 1.5rem;
  font-size: 0.86rem;
  color: var(--gray);
}
.auth-switch a {
  color: var(--gold);
  cursor: pointer;
  text-decoration: none;
  font-weight: 600;
  transition: var(--trans);
}
.auth-switch a:hover { color: var(--gold2) }

/* Back to store */
.back-store {
  text-align: center;
  margin-top: 1.2rem;
}
.back-store a {
  color: var(--gray);
  font-size: 0.82rem;
  text-decoration: none;
  transition: var(--trans);
  display: inline-flex;
  align-items: center;
  gap: 0.4rem;
}
.back-store a:hover { color: var(--light) }

/* ══════════════════════════════
   PASSWORD STRENGTH BAR
══════════════════════════════ */
.strength-bar {
  height: 4px;
  border-radius: 2px;
  background: var(--border);
  margin-top: 0.5rem;
  overflow: hidden;
}
.strength-fill {
  height: 100%;
  border-radius: 2px;
  transition: width 0.4s ease, background 0.4s ease;
  width: 0%;
}
.strength-text {
  font-size: 0.74rem;
  margin-top: 0.3rem;
  transition: var(--trans);
}

/* ══════════════════════════════
   ADMIN CREDENTIALS HINT
══════════════════════════════ */
.hint-box {
  background: rgba(201,168,76,0.07);
  border: 1px dashed rgba(201,168,76,0.3);
  border-radius: 8px;
  padding: 0.8rem 1rem;
  margin-bottom: 1.2rem;
  font-size: 0.8rem;
  color: var(--gray);
  line-height: 1.6;
}
.hint-box strong { color: var(--gold) }

/* ══════════════════════════════
   SPINNER
══════════════════════════════ */
.spinner {
  width: 16px; height: 16px;
  border: 2px solid rgba(0,0,0,0.3);
  border-top-color: var(--black);
  border-radius: 50%;
  animation: spin 0.6s linear infinite;
  display: none;
}
@keyframes spin { to { transform: rotate(360deg) } }

/* ══════════════════════════════
   TOAST
══════════════════════════════ */
.toast-wrap {
  position: fixed;
  bottom: 2rem; right: 2rem;
  z-index: 9999;
  display: flex;
  flex-direction: column;
  gap: 0.75rem;
}
.toast {
  background: var(--card);
  border: 1px solid var(--border);
  border-radius: 10px;
  padding: 0.85rem 1.3rem;
  display: flex; align-items: center; gap: 0.65rem;
  min-width: 250px;
  box-shadow: 0 8px 24px rgba(0,0,0,0.4);
  animation: toastIn 0.3s ease;
}
.toast.success { border-left: 3px solid var(--green) }
.toast.error   { border-left: 3px solid var(--red) }
.toast.info    { border-left: 3px solid var(--gold) }
@keyframes toastIn {
  from { transform: translateX(110%); opacity: 0 }
  to   { transform: translateX(0);   opacity: 1 }
}
</style>
</head>
<body>

<!-- ══════════════════════════════════════
     LOGIN PAGE
══════════════════════════════════════ -->
<div class="auth-page active" id="page-login">
  <div class="auth-card">

    <div class="auth-logo">
      <div class="brand">LUXE</div>
      <div class="badge">🔐 Admin Access Only</div>
    </div>
    <p class="auth-subtitle">Sign in to your admin panel</p>

    <!-- Hint box showing default credentials -->
    <div class="hint-box">
      💡 <strong>Default Admin Credentials:</strong><br/>
      Email: <strong>admin@luxe.com</strong><br/>
      Password: <strong>Admin@1234</strong>
    </div>

    <!-- Error Alert -->
    <div class="alert alert-error" id="login-alert">
      <span>⚠️</span>
      <span id="login-alert-msg">Invalid email or password.</span>
    </div>

    <form  method="POST" action="../../backend/authentication.php" novalidate>

      <!-- Email -->
      <div class="form-group" id="fg-email">
        <label>Admin user</label>
        <div class="input-wrap">
          <span class="input-icon">📧</span>
          <input
            type="email"
            id="login-email"
            name="email"
            placeholder="admin@luxe.com"
            autocomplete="email"
          />
        </div>
        <span class="error-msg" id="err-email">Please enter a valid email address</span>
      </div>

      <!-- Password -->
      <div class="form-group" id="fg-password">
        <label>Password</label>
        <div class="input-wrap">
          <span class="input-icon">🔒</span>
          <input
            type="password"
            id="login-password"
            name="password"
            placeholder="Enter your password"
            autocomplete="current-password"
          />
          <button type="submit" class="toggle-pass" >👁️</button>
        </div>
        <span class="error-msg" id="err-password">Password must be at least 6 characters</span>
      </div>

      <!-- Remember me + forgot -->
      <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1.2rem; font-size:0.82rem;">
        <label style="display:flex; align-items:center; gap:0.5rem; cursor:pointer; color:var(--gray)">
          <input type="checkbox" id="remember-me" style="accent-color:var(--gold)"/>
          Remember me
        </label>
        <a href="#" style="color:var(--gold); text-decoration:none;" onclick="showForgot()">Forgot password?</a>
      </div>

      <button type="submit" class="btn-submit" id="login-btn">
        <div class="spinner" id="login-spinner"></div>
        <span id="login-btn-text">Sign In to Admin Panel</span>
      </button>

    </form>

    <div class="divider">or</div>

    <div class="auth-switch">
      Don't have an admin account?
      <a onclick="showPage('register')">Request Access</a>
    </div>

    <div class="back-store">
      <a href="ecommerce.html">← Back to Store</a>
    </div>

  </div>
</div>

<!-- ══════════════════════════════════════
     REGISTER PAGE
══════════════════════════════════════ -->
<div class="auth-page" id="page-register">
  <div class="auth-card">

    <div class="auth-logo">
      <div class="brand">LUXE</div>
      <div class="badge">⚙️ Admin Registration</div>
    </div>
    <p class="auth-subtitle">Create a new admin account</p>

    <!-- Success Alert -->
    <div class="alert alert-success" id="reg-success">
      <span>✅</span>
      <span>Account created! You can now sign in.</span>
    </div>

    <!-- Error Alert -->
    <div class="alert alert-error" id="reg-alert">
      <span>⚠️</span>
      <span id="reg-alert-msg">Something went wrong.</span>
    </div>

    <form id="register-form" onsubmit="handleRegister(event)" novalidate>

      <!-- Full Name row -->
      <div style="display:grid; grid-template-columns:1fr 1fr; gap:0.85rem;">
        <div class="form-group" id="fg-fname">
          <label>First Name</label>
          <div class="input-wrap">
            <span class="input-icon">👤</span>
            <input type="text" id="reg-fname" placeholder="John" autocomplete="given-name"/>
          </div>
          <span class="error-msg">Required</span>
        </div>
        <div class="form-group" id="fg-lname">
          <label>Last Name</label>
          <div class="input-wrap">
            <span class="input-icon">👤</span>
            <input type="text" id="reg-lname" placeholder="Doe" autocomplete="family-name"/>
          </div>
          <span class="error-msg">Required</span>
        </div>
      </div>

      <!-- Email -->
      <div class="form-group" id="fg-reg-email">
        <label>Email Address</label>
        <div class="input-wrap">
          <span class="input-icon">📧</span>
          <input type="email" id="reg-email" placeholder="admin@luxe.com" autocomplete="email"/>
        </div>
        <span class="error-msg">Please enter a valid email</span>
      </div>

      <!-- Role -->
      <div class="form-group">
        <label>Admin Role</label>
        <div class="input-wrap">
          <span class="input-icon">🛡️</span>
          <select id="reg-role" style="
            width:100%;
            background:var(--dark2);
            border:1px solid var(--border);
            color:var(--white);
            padding:0.8rem 1rem 0.8rem 2.6rem;
            border-radius:10px;
            font-size:0.88rem;
            font-family:'Georgia',serif;
            cursor:pointer;
            transition:var(--trans);
          ">
            <option value="editor">Editor — Manage products & orders</option>
            <option value="manager">Manager — Full access except settings</option>
            <option value="superadmin">Super Admin — Full access</option>
          </select>
        </div>
      </div>

      <!-- Password -->
      <div class="form-group" id="fg-reg-pass">
        <label>Password</label>
        <div class="input-wrap">
          <span class="input-icon">🔒</span>
          <input
            type="password"
            id="reg-password"
            placeholder="Min 8 characters"
            autocomplete="new-password"
            oninput="checkStrength(this.value)"
          />
          <button type="button" class="toggle-pass" onclick="togglePassword('reg-password', this)">👁️</button>
        </div>
        <!-- Password strength -->
        <div class="strength-bar"><div class="strength-fill" id="strength-fill"></div></div>
        <div class="strength-text" id="strength-text" style="color:var(--gray)">Enter a password</div>
        <span class="error-msg">Password must be at least 8 characters</span>
      </div>

      <!-- Confirm Password -->
      <div class="form-group" id="fg-reg-confirm">
        <label>Confirm Password</label>
        <div class="input-wrap">
          <span class="input-icon">🔒</span>
          <input
            type="password"
            id="reg-confirm"
            placeholder="Repeat password"
            autocomplete="new-password"
          />
          <button type="button" class="toggle-pass" onclick="togglePassword('reg-confirm', this)">👁️</button>
        </div>
        <span class="error-msg">Passwords do not match</span>
      </div>

      <!-- Terms -->
      <div class="form-group" id="fg-terms">
        <label style="display:flex; align-items:center; gap:0.6rem; cursor:pointer; text-transform:none; font-size:0.83rem; color:var(--gray)">
          <input type="checkbox" id="reg-terms" style="accent-color:var(--gold); width:16px; height:16px;"/>
          I agree to the <a href="#" style="color:var(--gold)">Admin Terms of Use</a>
        </label>
        <span class="error-msg">You must agree to the terms</span>
      </div>

      <button type="submit" class="btn-submit" id="reg-btn">
        <div class="spinner" id="reg-spinner"></div>
        <span id="reg-btn-text">Create Admin Account</span>
      </button>

    </form>

    <div class="divider">or</div>

    <div class="auth-switch">
      Already have an account?
      <a onclick="showPage('login')">Sign In</a>
    </div>

    <div class="back-store">
      <a href="ecommerce.html">← Back to Store</a>
    </div>

  </div>
</div>

<!-- Toast Container -->
<div class="toast-wrap" id="toast-wrap"></div>

<script>
/* ══════════════════════════════════════
   ADMIN CREDENTIALS
   In real app these would be on server
══════════════════════════════════════ */
var ADMIN_ACCOUNTS = [
  { email: 'admin@luxe.com', password: 'Admin@1234', name: 'Super Admin', role: 'superadmin' }
];

/* ══════════════════════════════════════
   PAGE SWITCHER
══════════════════════════════════════ */
function showPage(id) {
  document.querySelectorAll('.auth-page').forEach(function(p) {
    p.classList.remove('active');
  });
  document.getElementById('page-' + id).classList.add('active');

  // Clear alerts
  hideAlert('login-alert');
  hideAlert('reg-success');
  hideAlert('reg-alert');
}

/* ══════════════════════════════════════
   SHOW / HIDE ALERTS
══════════════════════════════════════ */
function showAlert(id, msg) {
  var el = document.getElementById(id);
  if (!el) return;
  if (msg) {
    var msgEl = el.querySelector('span:last-child');
    if (msgEl) msgEl.textContent = msg;
  }
  el.classList.add('show');
}

function hideAlert(id) {
  var el = document.getElementById(id);
  if (el) el.classList.remove('show');
}

/* ══════════════════════════════════════
   TOGGLE PASSWORD VISIBILITY
══════════════════════════════════════ */
function togglePassword(inputId, btn) {
  var input = document.getElementById(inputId);
  if (input.type === 'password') {
    input.type = 'text';
    btn.textContent = '🙈';
  } else {
    input.type = 'password';
    btn.textContent = '👁️';
  }
}

/* ══════════════════════════════════════
   PASSWORD STRENGTH CHECKER
══════════════════════════════════════ */
function checkStrength(val) {
  var fill = document.getElementById('strength-fill');
  var text = document.getElementById('strength-text');
  var score = 0;

  if (val.length >= 8)            score++;   // length
  if (/[A-Z]/.test(val))          score++;   // uppercase
  if (/[0-9]/.test(val))          score++;   // number
  if (/[^A-Za-z0-9]/.test(val))  score++;   // special char

  var levels = [
    { label: 'Too weak',  color: '#e05252', width: '20%' },
    { label: 'Weak',      color: '#ff9800', width: '40%' },
    { label: 'Fair',      color: '#ffc107', width: '60%' },
    { label: 'Strong',    color: '#4caf7d', width: '80%' },
    { label: 'Very strong',color:'#4caf7d', width: '100%'},
  ];

  if (val.length === 0) {
    fill.style.width = '0%';
    text.textContent = 'Enter a password';
    text.style.color = 'var(--gray)';
    return;
  }

  var lvl = levels[score] || levels[0];
  fill.style.width     = lvl.width;
  fill.style.background = lvl.color;
  text.textContent     = lvl.label;
  text.style.color     = lvl.color;
}

/* ══════════════════════════════════════
   FIELD VALIDATOR
══════════════════════════════════════ */
function validateField(groupId, isValid) {
  var group = document.getElementById(groupId);
  if (!group) return isValid;
  if (!isValid) {
    group.classList.add('invalid');
    group.classList.remove('valid');
  } else {
    group.classList.remove('invalid');
    group.classList.add('valid');
  }
  return isValid;
}

/* ══════════════════════════════════════
   LOADING STATE
══════════════════════════════════════ */
function setLoading(btnId, spinnerId, textId, loading) {
  var btn     = document.getElementById(btnId);
  var spinner = document.getElementById(spinnerId);
  var text    = document.getElementById(textId);
  btn.disabled           = loading;
  spinner.style.display  = loading ? 'block' : 'none';
  text.style.opacity     = loading ? '0.6' : '1';
}

/* ══════════════════════════════════════
   HANDLE LOGIN
══════════════════════════════════════ */
function handleLogin(e) {
  e.preventDefault();
  hideAlert('login-alert');

  var email    = document.getElementById('login-email').value.trim();
  var password = document.getElementById('login-password').value;
  var valid    = true;

  // Validate email
  valid = validateField('fg-email', /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) && valid;

  // Validate password
  valid = validateField('fg-password', password.length >= 6) && valid;

  if (!valid) return;

  // Show loading spinner
  setLoading('login-btn', 'login-spinner', 'login-btn-text', true);

  // Simulate a small delay (like a real server call)
  setTimeout(function() {
    setLoading('login-btn', 'login-spinner', 'login-btn-text', false);

    // Check credentials
    var account = ADMIN_ACCOUNTS.find(function(a) {
      return a.email === email && a.password === password;
    });

    if (account) {
      // ✅ Correct — store session & redirect
      sessionStorage.setItem('admin_logged_in', 'true');
      sessionStorage.setItem('admin_name', account.name);
      sessionStorage.setItem('admin_role', account.role);
      sessionStorage.setItem('admin_email', account.email);

      showToast('Welcome back, ' + account.name + '! 👋', 'success');

      // Redirect to admin panel after brief delay
      setTimeout(function() {
        window.location.href = 'admin.html';
      }, 1000);

    } else {
      // ❌ Wrong credentials
      showAlert('login-alert', 'Invalid email or password. Please try again.');
      // Shake the card
      var card = document.querySelector('#page-login .auth-card');
      card.style.animation = 'none';
      card.offsetHeight; // reflow
      card.style.animation = 'shake 0.4s ease';
    }
  }, 800);
}

/* ══════════════════════════════════════
   HANDLE REGISTER
══════════════════════════════════════ */
function handleRegister(e) {
  e.preventDefault();
  hideAlert('reg-alert');
  hideAlert('reg-success');

  var fname    = document.getElementById('reg-fname').value.trim();
  var lname    = document.getElementById('reg-lname').value.trim();
  var email    = document.getElementById('reg-email').value.trim();
  var password = document.getElementById('reg-password').value;
  var confirm  = document.getElementById('reg-confirm').value;
  var terms    = document.getElementById('reg-terms').checked;
  var valid    = true;

  // Validate each field
  valid = validateField('fg-fname',       fname.length >= 2)                           && valid;
  valid = validateField('fg-lname',       lname.length >= 2)                           && valid;
  valid = validateField('fg-reg-email',   /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email))   && valid;
  valid = validateField('fg-reg-pass',    password.length >= 8)                        && valid;
  valid = validateField('fg-reg-confirm', confirm === password && confirm.length > 0)  && valid;

  // Terms check
  var termsGroup = document.getElementById('fg-terms');
  if (!terms) {
    termsGroup.classList.add('invalid');
    valid = false;
  } else {
    termsGroup.classList.remove('invalid');
  }

  if (!valid) return;

  // Check if email already exists
  var exists = ADMIN_ACCOUNTS.find(function(a) { return a.email === email });
  if (exists) {
    showAlert('reg-alert', 'An account with this email already exists.');
    return;
  }

  // Loading
  setLoading('reg-btn', 'reg-spinner', 'reg-btn-text', true);

  setTimeout(function() {
    setLoading('reg-btn', 'reg-spinner', 'reg-btn-text', false);

    // Add new admin account
    var role = document.getElementById('reg-role').value;
    ADMIN_ACCOUNTS.push({
      email: email,
      password: password,
      name: fname + ' ' + lname,
      role: role
    });

    // Show success + reset form
    showAlert('reg-success');
    document.getElementById('register-form').reset();
    document.getElementById('strength-fill').style.width = '0%';
    document.getElementById('strength-text').textContent = 'Enter a password';
    document.querySelectorAll('.form-group').forEach(function(g) {
      g.classList.remove('valid', 'invalid');
    });

    showToast('Account created! You can now sign in.', 'success');

    // Switch to login after delay
    setTimeout(function() { showPage('login') }, 2000);

  }, 800);
}

/* ══════════════════════════════════════
   FORGOT PASSWORD (placeholder)
══════════════════════════════════════ */
function showForgot() {
  showToast('Password reset link sent to your email!', 'info');
}

/* ══════════════════════════════════════
   TOAST
══════════════════════════════════════ */
function showToast(msg, type) {
  type = type || 'info';
  var icons = { success: '✅', error: '❌', info: 'ℹ️' };
  var wrap  = document.getElementById('toast-wrap');
  var el    = document.createElement('div');
  el.className = 'toast ' + type;
  el.innerHTML =
    '<span>' + icons[type] + '</span>' +
    '<span style="font-size:0.86rem">' + msg + '</span>';
  wrap.appendChild(el);
  setTimeout(function() {
    el.style.animation = 'toastIn 0.3s ease reverse';
    setTimeout(function() { el.remove() }, 280);
  }, 3000);
}

/* ══════════════════════════════════════
   SHAKE ANIMATION
══════════════════════════════════════ */
var style = document.createElement('style');
style.textContent = '@keyframes shake { 0%,100%{transform:translateX(0)} 20%,60%{transform:translateX(-8px)} 40%,80%{transform:translateX(8px)} }';
document.head.appendChild(style);

/* ══════════════════════════════════════
   REAL-TIME VALIDATION ON BLUR
══════════════════════════════════════ */
document.addEventListener('DOMContentLoaded', function() {

  // Login email
  document.getElementById('login-email').addEventListener('blur', function() {
    validateField('fg-email', /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(this.value.trim()));
  });

  // Login password
  document.getElementById('login-password').addEventListener('blur', function() {
    validateField('fg-password', this.value.length >= 6);
  });

  // Register fields
  document.getElementById('reg-fname').addEventListener('blur', function() {
    validateField('fg-fname', this.value.trim().length >= 2);
  });
  document.getElementById('reg-lname').addEventListener('blur', function() {
    validateField('fg-lname', this.value.trim().length >= 2);
  });
  document.getElementById('reg-email').addEventListener('blur', function() {
    validateField('fg-reg-email', /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(this.value.trim()));
  });
  document.getElementById('reg-password').addEventListener('blur', function() {
    validateField('fg-reg-pass', this.value.length >= 8);
  });
  document.getElementById('reg-confirm').addEventListener('blur', function() {
    var pass = document.getElementById('reg-password').value;
    validateField('fg-reg-confirm', this.value === pass && this.value.length > 0);
  });

});
</script>

</body>
</html>