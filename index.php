<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>LUXE — Premium Luxury eCommerce</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
/* ════════════════════════════════════════
   CSS VARIABLES & RESET
════════════════════════════════════════ */
:root {
  --black: #000000;
  --dark: #0a0a0a;
  --dark2: #111111;
  --dark3: #1a1a1a;
  --card: #141414;
  --card2: #1c1c1c;
  --border: #2a2a2a;
  --border-light: #333333;
  --gold: #d4af37;
  --gold2: #f4cf67;
  --gold3: #c49b2a;
  --gold-glow: rgba(212, 175, 55, 0.3);
  --white: #ffffff;
  --off-white: #f8f6f3;
  --gray: #888888;
  --gray-light: #aaaaaa;
  --gray-dark: #666666;
  --red: #ff4757;
  --green: #2ed573;
  --blue: #3742fa;
  --radius-sm: 8px;
  --radius: 12px;
  --radius-lg: 20px;
  --radius-xl: 30px;
  --shadow-sm: 0 4px 12px rgba(0,0,0,0.3);
  --shadow: 0 8px 32px rgba(0,0,0,0.4);
  --shadow-lg: 0 20px 60px rgba(0,0,0,0.5);
  --shadow-gold: 0 8px 32px rgba(212,175,55,0.25);
  --transition-fast: all 0.2s cubic-bezier(0.4,0,0.2,1);
  --transition: all 0.3s cubic-bezier(0.4,0,0.2,1);
  --transition-slow: all 0.5s cubic-bezier(0.4,0,0.2,1);
  --transition-bounce: all 0.4s cubic-bezier(0.68,-0.55,0.265,1.55);
  --font-display: 'Playfair Display', Georgia, serif;
  --font-body: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
}

*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
html{scroll-behavior:smooth;font-size:16px}
body{
  font-family:var(--font-body);
  background:var(--dark);
  color:var(--white);
  line-height:1.7;
  overflow-x:hidden;
  -webkit-font-smoothing:antialiased;
  -moz-osx-font-smoothing:grayscale;
}
a{text-decoration:none;color:inherit;transition:var(--transition)}
button{cursor:pointer;border:none;outline:none;font-family:inherit;transition:var(--transition)}
img{max-width:100%;display:block}
ul{list-style:none}
input,select,textarea{font-family:inherit;outline:none;transition:var(--transition)}

/* Selection */
::selection{background:var(--gold);color:var(--black)}

/* ════════════════════════════════════════
   CUSTOM SCROLLBAR
════════════════════════════════════════ */
::-webkit-scrollbar{width:8px}
::-webkit-scrollbar-track{background:var(--dark)}
::-webkit-scrollbar-thumb{background:linear-gradient(180deg,var(--gold),var(--gold3));border-radius:4px}
::-webkit-scrollbar-thumb:hover{background:var(--gold2)}

/* ════════════════════════════════════════
   LOADING SCREEN
════════════════════════════════════════ */
.loading-screen{
  position:fixed;inset:0;z-index:10000;
  background:var(--black);
  display:flex;flex-direction:column;
  align-items:center;justify-content:center;
  transition:opacity 0.6s ease, visibility 0.6s ease;
}
.loading-screen.hidden{opacity:0;visibility:hidden;pointer-events:none}
.loading-logo{
  font-family:var(--font-display);
  font-size:3rem;letter-spacing:0.3em;
  color:var(--gold);
  animation:pulse-gold 1.5s ease-in-out infinite;
}
.loading-bar{
  width:200px;height:2px;
  background:var(--border);
  margin-top:2rem;border-radius:2px;
  overflow:hidden;
}
.loading-bar::after{
  content:'';display:block;
  width:40%;height:100%;
  background:linear-gradient(90deg,transparent,var(--gold),transparent);
  animation:loading-slide 1s ease-in-out infinite;
}
@keyframes loading-slide{0%{transform:translateX(-100%)}100%{transform:translateX(350%)}}
@keyframes pulse-gold{0%,100%{opacity:1}50%{opacity:0.5}}

/* ════════════════════════════════════════
   CURSOR (Desktop only)
════════════════════════════════════════ */
.cursor{
  position:fixed;width:20px;height:20px;
  border:1.5px solid var(--gold);
  border-radius:50%;
  pointer-events:none;z-index:9999;
  transition:transform 0.15s ease, opacity 0.15s ease;
  mix-blend-mode:difference;
}
.cursor-dot{
  position:fixed;width:6px;height:6px;
  background:var(--gold);border-radius:50%;
  pointer-events:none;z-index:9999;
  transition:transform 0.1s ease;
}
.cursor.hover{transform:scale(2);border-color:var(--gold2)}
.cursor-dot.hover{transform:scale(0.5)}

/* ════════════════════════════════════════
   PAGES
════════════════════════════════════════ */
.page{display:none;animation:pageIn 0.6s ease}
.page.active{display:block}
@keyframes pageIn{
  from{opacity:0;transform:translateY(20px)}
  to{opacity:1;transform:translateY(0)}
}

/* ════════════════════════════════════════
   NAVBAR
════════════════════════════════════════ */
.navbar{
  position:fixed;top:0;left:0;right:0;z-index:1000;
  background:rgba(0,0,0,0.85);
  backdrop-filter:blur(20px);
  -webkit-backdrop-filter:blur(20px);
  border-bottom:1px solid rgba(255,255,255,0.05);
  padding:0 4%;
  display:flex;align-items:center;justify-content:space-between;
  height:80px;
  transition:var(--transition);
}
.navbar.scrolled{
  height:70px;
  background:rgba(0,0,0,0.95);
  box-shadow:0 4px 30px rgba(0,0,0,0.3);
}
.nav-logo{
  font-family:var(--font-display);
  font-size:1.8rem;letter-spacing:0.2em;font-weight:600;
  background:linear-gradient(135deg,var(--gold2),var(--gold),var(--gold3));
  -webkit-background-clip:text;
  -webkit-text-fill-color:transparent;
  background-clip:text;
  text-transform:uppercase;
  position:relative;
}
.nav-logo::after{
  content:'®';font-size:0.5rem;
  position:absolute;top:0;right:-15px;
  color:var(--gold);
  -webkit-text-fill-color:var(--gold);
}
.nav-links{display:flex;align-items:center;gap:3rem}
.nav-link{
  font-size:0.75rem;letter-spacing:0.15em;text-transform:uppercase;
  color:var(--gray-light);font-weight:500;
  position:relative;padding:0.5rem 0;
}
.nav-link::after{
  content:'';position:absolute;bottom:0;left:0;
  width:0;height:1px;
  background:linear-gradient(90deg,var(--gold),var(--gold2));
  transition:var(--transition);
}
.nav-link:hover{color:var(--white)}
.nav-link:hover::after{width:100%}
.nav-right{display:flex;align-items:center;gap:0.5rem}
.nav-icon-btn{
  background:none;color:var(--gray-light);
  font-size:1.1rem;
  width:44px;height:44px;
  border-radius:50%;
  display:flex;align-items:center;justify-content:center;
  position:relative;
  border:1px solid transparent;
}
.nav-icon-btn:hover{
  color:var(--gold);
  background:rgba(212,175,55,0.1);
  border-color:rgba(212,175,55,0.3);
}
.nav-icon-btn svg{width:20px;height:20px;stroke-width:1.5}
.cart-count{
  position:absolute;top:2px;right:2px;
  background:linear-gradient(135deg,var(--gold),var(--gold3));
  color:var(--black);
  font-size:0.65rem;font-weight:700;
  min-width:18px;height:18px;border-radius:50%;
  display:flex;align-items:center;justify-content:center;
  font-family:var(--font-body);
  box-shadow:0 2px 8px var(--gold-glow);
}
.nav-auth-btns{display:flex;gap:0.75rem;margin-left:1rem}
.nav-auth-btn{
  font-size:0.7rem;letter-spacing:0.1em;text-transform:uppercase;
  padding:0.6rem 1.2rem;border-radius:var(--radius-sm);
  font-weight:600;
}
.nav-auth-btn.outline{
  background:transparent;color:var(--gold);
  border:1px solid var(--gold);
}
.nav-auth-btn.outline:hover{
  background:var(--gold);color:var(--black);
  box-shadow:var(--shadow-gold);
}
.nav-auth-btn.filled{
  background:linear-gradient(135deg,var(--gold),var(--gold3));
  color:var(--black);border:none;
}
.nav-auth-btn.filled:hover{
  transform:translateY(-2px);
  box-shadow:var(--shadow-gold);
}

/* Hamburger */
.hamburger{
  display:none;flex-direction:column;gap:6px;
  background:none;padding:10px;
  width:44px;height:44px;
  justify-content:center;align-items:center;
}
.hamburger span{
  width:22px;height:1.5px;
  background:var(--white);
  border-radius:2px;
  transition:var(--transition);
  transform-origin:center;
}
.hamburger.active span:nth-child(1){transform:rotate(45deg) translate(5px,5px)}
.hamburger.active span:nth-child(2){opacity:0}
.hamburger.active span:nth-child(3){transform:rotate(-45deg) translate(5px,-5px)}

/* Mobile Menu */
.mobile-menu{
  display:none;position:fixed;
  top:80px;left:0;right:0;bottom:0;
  background:var(--dark);
  z-index:999;padding:2rem;
  transform:translateX(-100%);
  transition:var(--transition);
}
.mobile-menu.open{transform:translateX(0)}
.mobile-menu a{
  display:flex;align-items:center;gap:1rem;
  padding:1rem 0;
  border-bottom:1px solid var(--border);
  font-size:1rem;letter-spacing:0.1em;
  font-weight:500;
}
.mobile-menu a:hover{color:var(--gold)}
.mobile-menu-footer{
  margin-top:auto;padding-top:2rem;
  display:flex;flex-direction:column;gap:1rem;
}

/* ════════════════════════════════════════
   BUTTONS
════════════════════════════════════════ */
.btn{
  display:inline-flex;align-items:center;justify-content:center;gap:0.6rem;
  padding:0.9rem 2rem;border-radius:var(--radius-sm);
  font-size:0.75rem;letter-spacing:0.12em;text-transform:uppercase;
  font-weight:600;position:relative;overflow:hidden;
}
.btn::before{
  content:'';position:absolute;inset:0;
  background:linear-gradient(135deg,rgba(255,255,255,0.2),transparent);
  opacity:0;transition:var(--transition);
}
.btn:hover::before{opacity:1}
.btn-gold{
  background:linear-gradient(135deg,var(--gold),var(--gold3));
  color:var(--black);
  box-shadow:0 4px 15px rgba(212,175,55,0.3);
}
.btn-gold:hover{
  transform:translateY(-3px);
  box-shadow:0 8px 25px rgba(212,175,55,0.4);
}
.btn-gold:active{transform:translateY(-1px)}
.btn-outline{
  background:transparent;color:var(--white);
  border:1px solid var(--border-light);
}
.btn-outline:hover{
  border-color:var(--gold);color:var(--gold);
  background:rgba(212,175,55,0.05);
}
.btn-white{
  background:var(--white);color:var(--black);
}
.btn-white:hover{
  transform:translateY(-3px);
  box-shadow:0 8px 25px rgba(255,255,255,0.2);
}
.btn-dark{background:var(--card2);color:var(--white)}
.btn-dark:hover{background:var(--border)}
.btn-red{background:var(--red);color:var(--white)}
.btn-red:hover{opacity:0.9}
.btn-sm{padding:0.6rem 1.4rem;font-size:0.7rem}
.btn-lg{padding:1.1rem 2.5rem;font-size:0.8rem}
.btn-icon{
  width:44px;height:44px;padding:0;
  border-radius:50%;
}

/* ════════════════════════════════════════
   HERO SECTION
════════════════════════════════════════ */
.hero{
  min-height:100vh;
  display:flex;align-items:center;
  background:var(--black);
  position:relative;overflow:hidden;
  padding:120px 6% 80px;
}
.hero-bg{
  position:absolute;inset:0;
  background:
    radial-gradient(ellipse at 80% 20%,rgba(212,175,55,0.08) 0%,transparent 50%),
    radial-gradient(ellipse at 20% 80%,rgba(212,175,55,0.05) 0%,transparent 50%),
    linear-gradient(180deg,var(--black) 0%,var(--dark) 100%);
}
.hero-pattern{
  position:absolute;inset:0;
  background-image:url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M30 0L30 60M0 30L60 30' stroke='%23ffffff' stroke-opacity='0.02' stroke-width='1'/%3E%3C/svg%3E");
  opacity:0.5;
}
.hero-content{
  max-width:700px;z-index:2;
  animation:heroIn 1s ease 0.3s both;
}
@keyframes heroIn{
  from{opacity:0;transform:translateY(40px)}
  to{opacity:1;transform:translateY(0)}
}
.hero-badge{
  display:inline-flex;align-items:center;gap:0.75rem;
  background:rgba(212,175,55,0.1);
  border:1px solid rgba(212,175,55,0.2);
  padding:0.5rem 1.25rem;border-radius:50px;
  margin-bottom:2rem;
  animation:badgeGlow 3s ease-in-out infinite;
}
@keyframes badgeGlow{
  0%,100%{box-shadow:0 0 20px rgba(212,175,55,0)}
  50%{box-shadow:0 0 30px rgba(212,175,55,0.2)}
}
.hero-badge-dot{
  width:8px;height:8px;
  background:var(--gold);
  border-radius:50%;
  animation:pulse 2s ease-in-out infinite;
}
@keyframes pulse{0%,100%{opacity:1;transform:scale(1)}50%{opacity:0.5;transform:scale(0.8)}}
.hero-badge-text{
  font-size:0.72rem;letter-spacing:0.2em;
  text-transform:uppercase;color:var(--gold);
  font-weight:500;
}
.hero h1{
  font-family:var(--font-display);
  font-size:clamp(3rem,7vw,5.5rem);
  line-height:1.05;margin-bottom:1.5rem;
  color:var(--white);font-weight:500;
}
.hero h1 .highlight{
  background:linear-gradient(135deg,var(--gold2),var(--gold),var(--gold3));
  -webkit-background-clip:text;
  -webkit-text-fill-color:transparent;
  background-clip:text;
}
.hero h1 .italic{font-style:italic;font-weight:400}
.hero-desc{
  color:var(--gray);font-size:1.1rem;
  margin-bottom:3rem;max-width:500px;
  line-height:1.8;
}
.hero-btns{display:flex;gap:1rem;flex-wrap:wrap;margin-bottom:4rem}
.hero-features{
  display:flex;gap:3rem;flex-wrap:wrap;
  padding-top:2rem;border-top:1px solid var(--border);
}
.hero-feature{display:flex;align-items:center;gap:0.75rem}
.hero-feature-icon{
  width:40px;height:40px;
  background:rgba(212,175,55,0.1);
  border:1px solid rgba(212,175,55,0.2);
  border-radius:50%;
  display:flex;align-items:center;justify-content:center;
  font-size:1rem;
}
.hero-feature-text{font-size:0.82rem;color:var(--gray-light)}
.hero-visual{
  position:absolute;right:5%;top:50%;
  transform:translateY(-50%);
  width:min(42%,520px);z-index:1;
}
.hero-card{
  background:linear-gradient(145deg,var(--card2),var(--card));
  border:1px solid var(--border);
  border-radius:var(--radius-xl);
  padding:2rem;
  box-shadow:var(--shadow-lg);
  animation:floatCard 6s ease-in-out infinite;
  position:relative;
}
.hero-card::before{
  content:'';position:absolute;inset:-1px;
  background:linear-gradient(135deg,var(--gold),transparent,var(--gold3));
  border-radius:var(--radius-xl);
  z-index:-1;opacity:0;
  transition:var(--transition);
}
.hero-card:hover::before{opacity:0.5}
.hero-card-img{
  width:100%;height:300px;
  background:linear-gradient(135deg,var(--dark3),var(--border));
  border-radius:var(--radius-lg);
  display:flex;align-items:center;justify-content:center;
  font-size:6rem;margin-bottom:1.5rem;
  position:relative;overflow:hidden;
}
.hero-card-img::before{
  content:'';position:absolute;inset:0;
  background:linear-gradient(135deg,transparent 40%,rgba(212,175,55,0.1));
}
.hero-card-info{display:flex;justify-content:space-between;align-items:flex-end}
.hero-card-details h3{
  font-family:var(--font-display);
  font-size:1.2rem;margin-bottom:0.25rem;
}
.hero-card-details .category{
  font-size:0.72rem;color:var(--gold);
  letter-spacing:0.1em;text-transform:uppercase;
}
.hero-card-price{
  font-family:var(--font-display);
  font-size:1.6rem;color:var(--gold);font-weight:600;
}
.hero-floating-badge{
  position:absolute;top:-15px;right:20px;
  background:var(--gold);color:var(--black);
  padding:0.5rem 1.25rem;border-radius:50px;
  font-size:0.7rem;font-weight:700;
  letter-spacing:0.08em;text-transform:uppercase;
  box-shadow:var(--shadow-gold);
}
@keyframes floatCard{
  0%,100%{transform:translateY(-50%) rotate(-1deg)}
  50%{transform:translateY(-52%) rotate(1deg)}
}

/* Scroll Indicator */
.scroll-indicator{
  position:absolute;bottom:40px;left:50%;
  transform:translateX(-50%);
  display:flex;flex-direction:column;
  align-items:center;gap:0.75rem;
  animation:scrollBounce 2s ease-in-out infinite;
}
.scroll-indicator span{
  font-size:0.65rem;letter-spacing:0.2em;
  text-transform:uppercase;color:var(--gray);
}
.scroll-mouse{
  width:24px;height:38px;
  border:1.5px solid var(--gray);
  border-radius:12px;
  position:relative;
}
.scroll-mouse::before{
  content:'';position:absolute;
  top:8px;left:50%;transform:translateX(-50%);
  width:3px;height:8px;
  background:var(--gold);border-radius:3px;
  animation:scrollWheel 2s ease-in-out infinite;
}
@keyframes scrollBounce{0%,100%{transform:translateX(-50%) translateY(0)}50%{transform:translateX(-50%) translateY(10px)}}
@keyframes scrollWheel{0%,100%{opacity:1;transform:translateX(-50%) translateY(0)}50%{opacity:0;transform:translateX(-50%) translateY(10px)}}

/* ════════════════════════════════════════
   MARQUEE
════════════════════════════════════════ */
.marquee-section{
  background:var(--card);
  border-top:1px solid var(--border);
  border-bottom:1px solid var(--border);
  padding:1rem 0;overflow:hidden;
}
.marquee{
  display:flex;
  animation:marquee 30s linear infinite;
}
.marquee-content{
  display:flex;gap:4rem;
  padding:0 2rem;
  white-space:nowrap;
}
.marquee-item{
  display:flex;align-items:center;gap:1rem;
  font-size:0.8rem;letter-spacing:0.1em;
  text-transform:uppercase;color:var(--gray);
}
.marquee-item span{color:var(--gold);font-size:1rem}
@keyframes marquee{0%{transform:translateX(0)}100%{transform:translateX(-50%)}}

/* ════════════════════════════════════════
   STATS BAR
════════════════════════════════════════ */
.stats-section{
  padding:5rem 6%;
  background:var(--dark);
  border-bottom:1px solid var(--border);
}
.stats-grid{
  display:grid;
  grid-template-columns:repeat(4,1fr);
  gap:2rem;
}
.stat-item{
  text-align:center;
  padding:2rem;
  background:var(--card);
  border:1px solid var(--border);
  border-radius:var(--radius-lg);
  transition:var(--transition);
}
.stat-item:hover{
  border-color:var(--gold);
  transform:translateY(-5px);
  box-shadow:var(--shadow-gold);
}
.stat-number{
  font-family:var(--font-display);
  font-size:3rem;font-weight:600;
  background:linear-gradient(135deg,var(--gold2),var(--gold));
  -webkit-background-clip:text;
  -webkit-text-fill-color:transparent;
  background-clip:text;
  margin-bottom:0.5rem;
}
.stat-label{
  font-size:0.75rem;letter-spacing:0.15em;
  text-transform:uppercase;color:var(--gray);
}

/* ════════════════════════════════════════
   SECTION STYLING
════════════════════════════════════════ */
.section{padding:6rem 6%}
.section-dark{background:var(--dark2)}
.section-header{
  text-align:center;
  margin-bottom:4rem;
  max-width:700px;
  margin-left:auto;margin-right:auto;
}
.section-tag{
  display:inline-flex;align-items:center;gap:0.75rem;
  font-size:0.7rem;letter-spacing:0.25em;
  text-transform:uppercase;
  color:var(--gold);
  margin-bottom:1rem;
}
.section-tag::before,.section-tag::after{
  content:'';width:30px;height:1px;
  background:linear-gradient(90deg,transparent,var(--gold));
}
.section-tag::after{background:linear-gradient(90deg,var(--gold),transparent)}
.section-title{
  font-family:var(--font-display);
  font-size:clamp(2rem,4vw,3rem);
  color:var(--white);line-height:1.2;
  margin-bottom:1rem;
}
.section-title .highlight{color:var(--gold)}
.section-sub{
  color:var(--gray);font-size:1rem;
  line-height:1.8;
}

/* ════════════════════════════════════════
   CATEGORIES
════════════════════════════════════════ */
.categories-grid{
  display:grid;
  grid-template-columns:repeat(6,1fr);
  gap:1.5rem;
}
.category-card{
  background:var(--card);
  border:1px solid var(--border);
  border-radius:var(--radius-lg);
  padding:2.5rem 1.5rem;
  text-align:center;
  cursor:pointer;
  transition:var(--transition);
  position:relative;overflow:hidden;
}
.category-card::before{
  content:'';position:absolute;inset:0;
  background:linear-gradient(135deg,rgba(212,175,55,0.1),transparent);
  opacity:0;transition:var(--transition);
}
.category-card:hover{
  border-color:var(--gold);
  transform:translateY(-8px);
  box-shadow:var(--shadow-gold);
}
.category-card:hover::before{opacity:1}
.category-card:hover .category-icon{transform:scale(1.15)}
.category-icon{
  font-size:3rem;margin-bottom:1rem;
  display:block;
  transition:var(--transition-bounce);
}
.category-name{
  font-size:0.85rem;letter-spacing:0.08em;
  text-transform:uppercase;color:var(--white);
  font-weight:500;margin-bottom:0.3rem;
}
.category-count{
  font-size:0.72rem;color:var(--gray);
}

/* ════════════════════════════════════════
   PRODUCT CARDS
════════════════════════════════════════ */
.products-grid{
  display:grid;
  grid-template-columns:repeat(auto-fill,minmax(280px,1fr));
  gap:2rem;
}
.product-card{
  background:var(--card);
  border:1px solid var(--border);
  border-radius:var(--radius-lg);
  overflow:hidden;
  transition:var(--transition);
  position:relative;
  group:hover;
}
.product-card:hover{
  transform:translateY(-10px);
  border-color:rgba(212,175,55,0.3);
  box-shadow:var(--shadow-lg);
}
.product-badge{
  position:absolute;top:15px;left:15px;z-index:3;
  background:var(--gold);color:var(--black);
  font-size:0.65rem;font-weight:700;
  letter-spacing:0.1em;
  padding:0.35rem 0.9rem;border-radius:50px;
  text-transform:uppercase;
  box-shadow:var(--shadow-sm);
}
.product-badge.sale{background:var(--red);color:var(--white)}
.product-badge.new{background:var(--green);color:var(--white)}
.product-wishlist{
  position:absolute;top:15px;right:15px;z-index:3;
  width:36px;height:36px;
  background:rgba(0,0,0,0.5);
  backdrop-filter:blur(10px);
  border:1px solid rgba(255,255,255,0.1);
  border-radius:50%;
  display:flex;align-items:center;justify-content:center;
  cursor:pointer;transition:var(--transition);
  font-size:0.9rem;
}
.product-wishlist:hover{
  background:var(--white);
  transform:scale(1.1);
}
.product-wishlist.active{
  background:var(--red);
  border-color:var(--red);
}
.product-img{
  width:100%;height:280px;
  background:linear-gradient(135deg,var(--dark3),var(--border));
  display:flex;align-items:center;justify-content:center;
  font-size:5rem;
  position:relative;overflow:hidden;
  transition:var(--transition);
}
.product-img::before{
  content:'';position:absolute;inset:0;
  background:linear-gradient(180deg,transparent 50%,rgba(0,0,0,0.8));
  opacity:0;transition:var(--transition);
}
.product-card:hover .product-img::before{opacity:1}
.product-actions{
  position:absolute;bottom:0;left:0;right:0;
  padding:1.5rem;
  display:flex;gap:0.75rem;
  transform:translateY(100%);
  transition:var(--transition);
}
.product-card:hover .product-actions{transform:translateY(0)}
.product-action-btn{
  flex:1;
  background:var(--white);color:var(--black);
  padding:0.75rem 1rem;border-radius:var(--radius-sm);
  font-size:0.7rem;font-weight:700;
  letter-spacing:0.08em;text-transform:uppercase;
  text-align:center;cursor:pointer;
  transition:var(--transition);
  border:none;
}
.product-action-btn:hover{
  background:var(--gold);
  transform:translateY(-2px);
}
.product-action-btn.primary{
  background:var(--gold);
  flex:2;
}
.product-action-btn.primary:hover{
  background:var(--gold2);
}
.product-body{padding:1.5rem}
.product-cat{
  font-size:0.68rem;color:var(--gold);
  letter-spacing:0.12em;text-transform:uppercase;
  margin-bottom:0.5rem;
}
.product-name{
  font-family:var(--font-display);
  font-size:1.05rem;color:var(--white);
  margin-bottom:0.75rem;line-height:1.4;
}
.product-rating{
  display:flex;align-items:center;gap:0.5rem;
  margin-bottom:1rem;
}
.stars{
  display:flex;gap:2px;
}
.star{color:var(--gold);font-size:0.8rem}
.star.empty{color:var(--border)}
.rating-text{font-size:0.75rem;color:var(--gray)}
.product-price{
  display:flex;align-items:baseline;gap:0.75rem;
}
.price-current{
  font-family:var(--font-display);
  font-size:1.3rem;font-weight:600;
  color:var(--gold);
}
.price-old{
  font-size:0.85rem;color:var(--gray);
  text-decoration:line-through;
}
.price-discount{
  font-size:0.7rem;color:var(--green);
  font-weight:600;
}

/* ════════════════════════════════════════
   PROMO SECTION
════════════════════════════════════════ */
.promo-section{
  margin:4rem 6%;
  background:linear-gradient(135deg,var(--dark3),var(--card));
  border:1px solid var(--border);
  border-radius:var(--radius-xl);
  padding:5rem;
  display:grid;grid-template-columns:1fr 1fr;gap:4rem;
  align-items:center;position:relative;overflow:hidden;
}
.promo-section::before{
  content:'';position:absolute;
  right:-150px;top:-150px;
  width:500px;height:500px;
  background:radial-gradient(circle,rgba(212,175,55,0.15),transparent 60%);
  border-radius:50%;
}
.promo-section::after{
  content:'';position:absolute;
  left:-100px;bottom:-100px;
  width:300px;height:300px;
  background:radial-gradient(circle,rgba(212,175,55,0.08),transparent 60%);
  border-radius:50%;
}
.promo-content{position:relative;z-index:1}
.promo-tag{
  display:inline-flex;align-items:center;gap:0.5rem;
  background:rgba(212,175,55,0.15);
  border:1px solid rgba(212,175,55,0.3);
  color:var(--gold);
  padding:0.5rem 1rem;border-radius:50px;
  font-size:0.7rem;letter-spacing:0.15em;
  text-transform:uppercase;font-weight:600;
  margin-bottom:1.5rem;
}
.promo-content h2{
  font-family:var(--font-display);
  font-size:clamp(2rem,4vw,2.8rem);
  line-height:1.2;margin-bottom:1.5rem;
}
.promo-content h2 .gold{color:var(--gold)}
.promo-content p{
  color:var(--gray);font-size:1rem;
  margin-bottom:2rem;line-height:1.8;
}
.promo-features{
  display:flex;flex-direction:column;gap:1rem;
  margin-bottom:2.5rem;
}
.promo-feature{
  display:flex;align-items:center;gap:1rem;
  font-size:0.9rem;color:var(--gray-light);
}
.promo-feature-icon{
  width:28px;height:28px;
  background:rgba(212,175,55,0.15);
  border-radius:50%;
  display:flex;align-items:center;justify-content:center;
  color:var(--gold);font-size:0.8rem;
}
.promo-visual{
  display:flex;align-items:center;justify-content:center;
  font-size:12rem;
  animation:floatPromo 4s ease-in-out infinite;
  position:relative;z-index:1;
}
@keyframes floatPromo{0%,100%{transform:translateY(0) rotate(-5deg)}50%{transform:translateY(-20px) rotate(5deg)}}

/* Countdown */
.countdown{
  display:flex;gap:1rem;margin-top:2rem;
}
.countdown-item{
  background:var(--card);
  border:1px solid var(--border);
  border-radius:var(--radius);
  padding:1rem 1.5rem;
  text-align:center;
  min-width:70px;
}
.countdown-value{
  font-family:var(--font-display);
  font-size:1.8rem;font-weight:600;
  color:var(--gold);
  display:block;
}
.countdown-label{
  font-size:0.65rem;letter-spacing:0.1em;
  text-transform:uppercase;color:var(--gray);
}

/* ════════════════════════════════════════
   TESTIMONIALS
════════════════════════════════════════ */
.testimonials-section{
  background:var(--black);
  padding:6rem 6%;
}
.testimonials-grid{
  display:grid;
  grid-template-columns:repeat(3,1fr);
  gap:2rem;
}
.testimonial-card{
  background:var(--card);
  border:1px solid var(--border);
  border-radius:var(--radius-lg);
  padding:2.5rem;
  transition:var(--transition);
  position:relative;
}
.testimonial-card:hover{
  border-color:rgba(212,175,55,0.3);
  transform:translateY(-5px);
}
.testimonial-quote{
  position:absolute;top:20px;right:25px;
  font-size:4rem;color:var(--gold);opacity:0.2;
  font-family:var(--font-display);
  line-height:1;
}
.testimonial-rating{
  display:flex;gap:3px;margin-bottom:1.5rem;
}
.testimonial-text{
  font-size:1rem;color:var(--gray-light);
  line-height:1.8;margin-bottom:2rem;
  font-style:italic;
}
.testimonial-author{
  display:flex;align-items:center;gap:1rem;
}
.testimonial-avatar{
  width:48px;height:48px;
  background:linear-gradient(135deg,var(--gold),var(--gold3));
  border-radius:50%;
  display:flex;align-items:center;justify-content:center;
  font-size:1.2rem;font-weight:600;
  color:var(--black);
}
.testimonial-info h4{
  font-size:0.95rem;margin-bottom:0.2rem;
}
.testimonial-info p{
  font-size:0.75rem;color:var(--gold);
}

/* ════════════════════════════════════════
   BRANDS
════════════════════════════════════════ */
.brands-section{
  padding:4rem 6%;
  background:var(--dark2);
  border-top:1px solid var(--border);
  border-bottom:1px solid var(--border);
}
.brands-grid{
  display:flex;align-items:center;
  justify-content:space-between;gap:3rem;
  opacity:0.5;
  flex-wrap:wrap;
}
.brand-item{
  font-family:var(--font-display);
  font-size:1.5rem;
  letter-spacing:0.1em;
  color:var(--gray);
  transition:var(--transition);
}
.brand-item:hover{color:var(--white);opacity:1}

/* ════════════════════════════════════════
   NEWSLETTER
════════════════════════════════════════ */
.newsletter-section{
  padding:6rem 6%;
  background:linear-gradient(135deg,var(--card),var(--dark3));
}
.newsletter-content{
  max-width:600px;
  margin:0 auto;
  text-align:center;
}
.newsletter-content h2{
  font-family:var(--font-display);
  font-size:2rem;margin-bottom:1rem;
}
.newsletter-content p{
  color:var(--gray);margin-bottom:2rem;
}
.newsletter-form{
  display:flex;gap:1rem;
  max-width:500px;margin:0 auto;
}
.newsletter-input{
  flex:1;
  background:var(--dark);
  border:1px solid var(--border);
  color:var(--white);
  padding:1rem 1.5rem;border-radius:var(--radius);
  font-size:0.9rem;
}
.newsletter-input:focus{border-color:var(--gold)}
.newsletter-input::placeholder{color:var(--gray)}

/* ════════════════════════════════════════
   FOOTER
════════════════════════════════════════ */
footer{
  background:var(--black);
  border-top:1px solid var(--border);
  padding:5rem 6% 2rem;
}
.footer-top{
  display:grid;
  grid-template-columns:2fr 1fr 1fr 1fr 1.5fr;
  gap:4rem;
  margin-bottom:4rem;
  padding-bottom:4rem;
  border-bottom:1px solid var(--border);
}
.footer-brand .logo{
  font-family:var(--font-display);
  font-size:1.8rem;letter-spacing:0.2em;
  background:linear-gradient(135deg,var(--gold2),var(--gold));
  -webkit-background-clip:text;
  -webkit-text-fill-color:transparent;
  background-clip:text;
  margin-bottom:1.5rem;
}
.footer-brand p{
  color:var(--gray);font-size:0.9rem;
  line-height:1.8;margin-bottom:2rem;
}
.social-links{display:flex;gap:0.75rem}
.social-btn{
  width:42px;height:42px;
  background:var(--card);
  border:1px solid var(--border);
  border-radius:var(--radius-sm);
  display:flex;align-items:center;justify-content:center;
  font-size:1rem;color:var(--gray);
  transition:var(--transition);
}
.social-btn:hover{
  border-color:var(--gold);
  color:var(--gold);
  transform:translateY(-3px);
}
.footer-col h4{
  font-size:0.75rem;letter-spacing:0.2em;
  text-transform:uppercase;color:var(--white);
  margin-bottom:1.5rem;
  position:relative;
}
.footer-col h4::after{
  content:'';position:absolute;
  bottom:-8px;left:0;
  width:30px;height:2px;
  background:var(--gold);
}
.footer-col ul li{margin-bottom:0.75rem}
.footer-col ul li a{
  color:var(--gray);font-size:0.88rem;
  transition:var(--transition);
  display:inline-flex;align-items:center;gap:0.5rem;
}
.footer-col ul li a:hover{color:var(--gold);transform:translateX(5px)}
.footer-contact-item{
  display:flex;align-items:center;gap:1rem;
  margin-bottom:1rem;
}
.footer-contact-icon{
  width:36px;height:36px;
  background:rgba(212,175,55,0.1);
  border-radius:50%;
  display:flex;align-items:center;justify-content:center;
  font-size:0.9rem;
}
.footer-contact-text{font-size:0.88rem;color:var(--gray)}
.footer-bottom{
  display:flex;align-items:center;
  justify-content:space-between;
  flex-wrap:wrap;gap:1rem;
}
.footer-bottom p{color:var(--gray);font-size:0.82rem}
.footer-bottom-links{display:flex;gap:2rem}
.footer-bottom-links a{
  color:var(--gray);font-size:0.82rem;
  transition:var(--transition);
}
.footer-bottom-links a:hover{color:var(--gold)}
.payment-methods{display:flex;gap:0.75rem}
.payment-method{
  width:48px;height:30px;
  background:var(--card);
  border:1px solid var(--border);
  border-radius:4px;
  display:flex;align-items:center;justify-content:center;
  font-size:0.7rem;color:var(--gray);
}

/* ════════════════════════════════════════
   BACK TO TOP
════════════════════════════════════════ */
.back-to-top{
  position:fixed;bottom:30px;right:30px;
  width:50px;height:50px;
  background:linear-gradient(135deg,var(--gold),var(--gold3));
  color:var(--black);
  border-radius:50%;
  display:flex;align-items:center;justify-content:center;
  font-size:1.2rem;
  cursor:pointer;
  box-shadow:var(--shadow-gold);
  opacity:0;visibility:hidden;
  transform:translateY(20px);
  transition:var(--transition);
  z-index:999;
}
.back-to-top.visible{
  opacity:1;visibility:visible;
  transform:translateY(0);
}
.back-to-top:hover{
  transform:translateY(-5px);
  box-shadow:0 10px 30px rgba(212,175,55,0.4);
}

/* ════════════════════════════════════════
   SHOP PAGE
════════════════════════════════════════ */
.page-hero{
  background:linear-gradient(135deg,var(--black),var(--dark2));
  padding:140px 6% 60px;
  position:relative;
  border-bottom:1px solid var(--border);
}
.page-hero::before{
  content:'';position:absolute;inset:0;
  background:radial-gradient(ellipse at 50% 0%,rgba(212,175,55,0.1),transparent 60%);
}
.breadcrumb{
  display:flex;align-items:center;gap:0.75rem;
  font-size:0.8rem;color:var(--gray);
  margin-bottom:1.5rem;
}
.breadcrumb a:hover{color:var(--gold)}
.breadcrumb span.separator{color:var(--border)}
.page-hero h1{
  font-family:var(--font-display);
  font-size:clamp(2rem,5vw,3.5rem);
  margin-bottom:0.75rem;
}
.page-hero p{color:var(--gray);font-size:1rem}

.shop-layout{
  display:grid;
  grid-template-columns:280px 1fr;
  gap:3rem;
  padding:3rem 6%;
}
.filters-sidebar{
  position:sticky;top:100px;
  height:fit-content;
}
.filter-header{
  display:flex;align-items:center;
  justify-content:space-between;
  margin-bottom:2rem;
  padding-bottom:1rem;
  border-bottom:1px solid var(--border);
}
.filter-header h3{
  font-size:1rem;font-weight:600;
  display:flex;align-items:center;gap:0.5rem;
}
.filter-clear{
  font-size:0.75rem;color:var(--gold);
  cursor:pointer;
}
.filter-clear:hover{text-decoration:underline}
.filter-group{margin-bottom:2rem}
.filter-title{
  font-size:0.75rem;letter-spacing:0.12em;
  text-transform:uppercase;color:var(--white);
  margin-bottom:1rem;
  font-weight:600;
}
.filter-options{
  display:flex;flex-direction:column;gap:0.75rem;
}
.filter-option{
  display:flex;align-items:center;gap:0.75rem;
  cursor:pointer;
  transition:var(--transition);
}
.filter-option:hover label{color:var(--white)}
.filter-option input[type="checkbox"],
.filter-option input[type="radio"]{
  width:18px;height:18px;
  accent-color:var(--gold);
  cursor:pointer;
}
.filter-option label{
  font-size:0.88rem;color:var(--gray);
  cursor:pointer;transition:var(--transition);
}
.price-slider{margin-top:1rem}
.price-slider input[type="range"]{
  width:100%;height:4px;
  background:var(--border);
  border-radius:2px;
  -webkit-appearance:none;
  cursor:pointer;
}
.price-slider input[type="range"]::-webkit-slider-thumb{
  -webkit-appearance:none;
  width:18px;height:18px;
  background:var(--gold);
  border-radius:50%;
  cursor:pointer;
  box-shadow:0 2px 8px rgba(212,175,55,0.4);
}
.price-labels{
  display:flex;justify-content:space-between;
  font-size:0.8rem;color:var(--gray);
  margin-top:0.75rem;
}

.shop-header{
  display:flex;align-items:center;
  justify-content:space-between;
  flex-wrap:wrap;gap:1rem;
  margin-bottom:2rem;
}
.result-count{color:var(--gray);font-size:0.9rem}
.shop-controls{display:flex;align-items:center;gap:1rem}
.search-box{
  display:flex;align-items:center;gap:0.75rem;
  background:var(--card);
  border:1px solid var(--border);
  border-radius:var(--radius);
  padding:0.75rem 1.25rem;
  transition:var(--transition);
}
.search-box:focus-within{border-color:var(--gold)}
.search-box input{
  background:none;border:none;
  color:var(--white);font-size:0.9rem;
  width:200px;
}
.search-box input::placeholder{color:var(--gray)}
.search-box svg{width:18px;height:18px;color:var(--gray)}
.sort-select{
  background:var(--card);
  border:1px solid var(--border);
  color:var(--white);
  padding:0.75rem 1.25rem;
  border-radius:var(--radius);
  font-size:0.85rem;
  cursor:pointer;
}
.sort-select:focus{border-color:var(--gold)}
.sort-select option{background:var(--dark)}
.view-toggles{display:flex;gap:0.5rem}
.view-toggle{
  width:40px;height:40px;
  background:var(--card);
  border:1px solid var(--border);
  border-radius:var(--radius-sm);
  display:flex;align-items:center;justify-content:center;
  color:var(--gray);cursor:pointer;
  transition:var(--transition);
}
.view-toggle.active,.view-toggle:hover{
  border-color:var(--gold);color:var(--gold);
}

/* ════════════════════════════════════════
   PRODUCT DETAIL PAGE
════════════════════════════════════════ */
.product-detail{
  padding:3rem 6%;
  display:grid;
  grid-template-columns:1fr 1fr;
  gap:5rem;
  align-items:start;
}
.detail-gallery{position:sticky;top:100px}
.main-img{
  width:100%;aspect-ratio:1;
  background:linear-gradient(135deg,var(--dark3),var(--border));
  border-radius:var(--radius-lg);
  display:flex;align-items:center;justify-content:center;
  font-size:10rem;
  border:1px solid var(--border);
  margin-bottom:1.5rem;
  position:relative;overflow:hidden;
}
.main-img::before{
  content:'';position:absolute;inset:0;
  background:radial-gradient(circle at 30% 30%,rgba(255,255,255,0.1),transparent);
}
.img-zoom{
  position:absolute;bottom:20px;right:20px;
  width:44px;height:44px;
  background:rgba(0,0,0,0.6);
  backdrop-filter:blur(10px);
  border:1px solid rgba(255,255,255,0.1);
  border-radius:50%;
  display:flex;align-items:center;justify-content:center;
  cursor:pointer;transition:var(--transition);
}
.img-zoom:hover{background:var(--gold);color:var(--black)}
.thumbs{display:flex;gap:1rem}
.thumb{
  width:80px;height:80px;
  background:var(--card);
  border:2px solid var(--border);
  border-radius:var(--radius);
  cursor:pointer;
  display:flex;align-items:center;justify-content:center;
  font-size:1.8rem;
  transition:var(--transition);
}
.thumb:hover,.thumb.active{border-color:var(--gold)}

.detail-info{padding:1rem 0}
.detail-badges{display:flex;gap:0.75rem;margin-bottom:1.5rem}
.detail-badge{
  padding:0.4rem 1rem;border-radius:50px;
  font-size:0.7rem;font-weight:600;
  letter-spacing:0.08em;text-transform:uppercase;
}
.detail-badge.bestseller{background:rgba(212,175,55,0.15);color:var(--gold);border:1px solid rgba(212,175,55,0.3)}
.detail-badge.stock{background:rgba(46,213,115,0.15);color:var(--green);border:1px solid rgba(46,213,115,0.3)}
.detail-cat{
  font-size:0.72rem;color:var(--gold);
  letter-spacing:0.15em;text-transform:uppercase;
  margin-bottom:0.75rem;
}
.detail-name{
  font-family:var(--font-display);
  font-size:2.2rem;line-height:1.2;
  margin-bottom:1.5rem;
}
.detail-rating{
  display:flex;align-items:center;gap:1.5rem;
  margin-bottom:2rem;
  padding-bottom:2rem;
  border-bottom:1px solid var(--border);
}
.detail-rating .stars{display:flex;gap:3px}
.rating-summary{display:flex;align-items:center;gap:0.5rem}
.rating-summary span{font-size:0.88rem;color:var(--gray)}
.detail-price{margin-bottom:2rem}
.detail-price .current{
  font-family:var(--font-display);
  font-size:2.5rem;font-weight:600;
  color:var(--gold);
}
.detail-price .old{
  font-size:1.2rem;color:var(--gray);
  text-decoration:line-through;
  margin-left:1rem;
}
.detail-price .discount{
  display:inline-block;
  background:rgba(46,213,115,0.15);
  color:var(--green);
  padding:0.3rem 0.8rem;
  border-radius:50px;
  font-size:0.75rem;font-weight:600;
  margin-left:1rem;
}
.detail-desc{
  color:var(--gray);font-size:0.95rem;
  line-height:1.9;margin-bottom:2rem;
  padding-bottom:2rem;
  border-bottom:1px solid var(--border);
}
.detail-options{margin-bottom:2rem}
.option-title{
  font-size:0.75rem;letter-spacing:0.12em;
  text-transform:uppercase;color:var(--white);
  margin-bottom:1rem;font-weight:600;
}
.color-options{display:flex;gap:0.75rem}
.color-dot{
  width:32px;height:32px;border-radius:50%;
  cursor:pointer;border:2px solid transparent;
  transition:var(--transition);
  position:relative;
}
.color-dot::after{
  content:'✓';position:absolute;inset:0;
  display:flex;align-items:center;justify-content:center;
  color:var(--white);font-size:0.8rem;
  opacity:0;transition:var(--transition);
}
.color-dot.active::after{opacity:1}
.color-dot:hover,.color-dot.active{
  transform:scale(1.15);
  border-color:var(--white);
  box-shadow:0 4px 12px rgba(0,0,0,0.3);
}
.size-options{display:flex;gap:0.75rem;flex-wrap:wrap}
.size-btn{
  min-width:50px;padding:0.6rem 1rem;
  background:var(--card);
  border:1px solid var(--border);
  border-radius:var(--radius-sm);
  font-size:0.85rem;color:var(--gray);
  cursor:pointer;transition:var(--transition);
  text-align:center;
}
.size-btn:hover,.size-btn.active{
  border-color:var(--gold);
  color:var(--gold);
  background:rgba(212,175,55,0.05);
}
.qty-row{
  display:flex;align-items:center;gap:2rem;
  margin-bottom:2rem;
}
.qty-label{
  font-size:0.75rem;letter-spacing:0.12em;
  text-transform:uppercase;color:var(--white);
  font-weight:600;
}
.qty-control{
  display:flex;align-items:center;
  background:var(--card);
  border:1px solid var(--border);
  border-radius:var(--radius);
  overflow:hidden;
}
.qty-btn{
  background:none;color:var(--white);
  width:48px;height:48px;
  font-size:1.3rem;
  display:flex;align-items:center;justify-content:center;
  transition:var(--transition);
}
.qty-btn:hover{background:var(--border);color:var(--gold)}
.qty-val{
  width:60px;text-align:center;
  font-size:1.1rem;font-weight:600;
  color:var(--white);background:none;border:none;
}
.detail-btns{
  display:flex;gap:1rem;flex-wrap:wrap;
  margin-bottom:2rem;
}
.detail-btns .btn{flex:1;min-width:150px;padding:1rem 1.5rem}
.detail-features{
  display:grid;grid-template-columns:repeat(3,1fr);
  gap:1rem;padding-top:2rem;
  border-top:1px solid var(--border);
}
.detail-feature{
  display:flex;flex-direction:column;
  align-items:center;text-align:center;
  gap:0.5rem;padding:1.5rem;
  background:var(--card);
  border:1px solid var(--border);
  border-radius:var(--radius);
}
.detail-feature-icon{font-size:1.5rem}
.detail-feature-text{
  font-size:0.75rem;color:var(--gray);
  line-height:1.5;
}

/* Reviews Section */
.reviews-section{
  padding:4rem 6%;
  border-top:1px solid var(--border);
  background:var(--dark2);
}
.reviews-header{
  display:flex;align-items:center;
  justify-content:space-between;
  margin-bottom:2.5rem;
}
.reviews-header h2{
  font-family:var(--font-display);
  font-size:1.5rem;
}
.reviews-grid{display:grid;gap:1.5rem}
.review-card{
  background:var(--card);
  border:1px solid var(--border);
  border-radius:var(--radius-lg);
  padding:2rem;
}
.review-header{
  display:flex;align-items:center;
  justify-content:space-between;
  margin-bottom:1rem;
}
.review-author{display:flex;align-items:center;gap:1rem}
.review-avatar{
  width:44px;height:44px;
  background:linear-gradient(135deg,var(--gold),var(--gold3));
  border-radius:50%;
  display:flex;align-items:center;justify-content:center;
  font-weight:600;color:var(--black);
}
.review-name{font-weight:600;margin-bottom:0.25rem}
.review-date{font-size:0.8rem;color:var(--gray)}
.review-stars{display:flex;gap:2px}
.review-text{
  color:var(--gray-light);
  line-height:1.8;
}
.review-verified{
  display:inline-flex;align-items:center;gap:0.5rem;
  font-size:0.75rem;color:var(--green);
  margin-top:1rem;
}

/* ════════════════════════════════════════
   CART PAGE
════════════════════════════════════════ */
.cart-layout{
  padding:3rem 6%;
  display:grid;
  grid-template-columns:1fr 400px;
  gap:3rem;
  align-items:start;
}
.cart-items{
  background:var(--card);
  border:1px solid var(--border);
  border-radius:var(--radius-lg);
  overflow:hidden;
}
.cart-header{
  display:grid;
  grid-template-columns:3fr 1fr 1.5fr 1fr 50px;
  padding:1.25rem 2rem;
  background:var(--dark3);
  font-size:0.72rem;letter-spacing:0.12em;
  text-transform:uppercase;color:var(--gray);
  gap:1.5rem;
}
.cart-row{
  display:grid;
  grid-template-columns:3fr 1fr 1.5fr 1fr 50px;
  padding:1.5rem 2rem;
  align-items:center;gap:1.5rem;
  border-bottom:1px solid var(--border);
  transition:var(--transition);
}
.cart-row:last-child{border-bottom:none}
.cart-row:hover{background:rgba(255,255,255,0.02)}
.cart-product{display:flex;align-items:center;gap:1.25rem}
.cart-img{
  width:80px;height:80px;
  background:var(--dark3);
  border-radius:var(--radius);
  display:flex;align-items:center;justify-content:center;
  font-size:2rem;flex-shrink:0;
  border:1px solid var(--border);
}
.cart-product-name{
  font-family:var(--font-display);
  font-size:1rem;margin-bottom:0.3rem;
}
.cart-product-meta{font-size:0.78rem;color:var(--gray)}
.cart-price{
  font-family:var(--font-display);
  color:var(--gold);font-weight:600;
}
.cart-qty-control{
  display:inline-flex;align-items:center;
  background:var(--dark3);
  border:1px solid var(--border);
  border-radius:var(--radius-sm);
  overflow:hidden;
}
.cart-qty-btn{
  background:none;color:var(--white);
  width:36px;height:36px;
  font-size:1rem;
}
.cart-qty-btn:hover{background:var(--border)}
.cart-qty-val{
  width:40px;text-align:center;
  font-size:0.9rem;color:var(--white);
  background:none;border:none;
}
.cart-total{
  font-family:var(--font-display);
  color:var(--white);font-weight:600;
  font-size:1.05rem;
}
.cart-remove{
  background:none;color:var(--gray);
  width:36px;height:36px;
  border-radius:50%;
  display:flex;align-items:center;justify-content:center;
  transition:var(--transition);
}
.cart-remove:hover{
  background:rgba(255,71,87,0.1);
  color:var(--red);
}
.cart-footer{
  display:flex;justify-content:space-between;
  align-items:center;flex-wrap:wrap;gap:1rem;
  margin-top:1.5rem;
}
.cart-summary{
  background:var(--card);
  border:1px solid var(--border);
  border-radius:var(--radius-lg);
  padding:2rem;
  position:sticky;top:100px;
}
.summary-title{
  font-family:var(--font-display);
  font-size:1.25rem;margin-bottom:2rem;
  padding-bottom:1rem;
  border-bottom:1px solid var(--border);
}
.summary-row{
  display:flex;justify-content:space-between;
  margin-bottom:0.75rem;font-size:0.95rem;
}
.summary-row .label{color:var(--gray)}
.summary-row.total{
  font-size:1.2rem;font-weight:700;
  margin-top:1.5rem;padding-top:1.5rem;
  border-top:1px solid var(--border);
}
.summary-row.total .value{
  color:var(--gold);
  font-family:var(--font-display);
  font-size:1.5rem;
}
.promo-box{
  margin:1.5rem 0;
  padding:1rem;
  background:var(--dark3);
  border-radius:var(--radius);
}
.promo-input{display:flex;gap:0.5rem}
.promo-input input{
  flex:1;
  background:var(--dark);
  border:1px solid var(--border);
  color:var(--white);
  padding:0.75rem 1rem;
  border-radius:var(--radius-sm);
  font-size:0.88rem;
}
.promo-input input:focus{border-color:var(--gold)}
.promo-input input::placeholder{color:var(--gray)}
.promo-success{
  display:flex;align-items:center;gap:0.5rem;
  font-size:0.82rem;color:var(--green);
  margin-top:0.75rem;
}
.secure-badges{
  display:flex;align-items:center;
  justify-content:center;gap:1rem;
  margin-top:1.5rem;padding-top:1.5rem;
  border-top:1px solid var(--border);
}
.secure-badge{
  display:flex;align-items:center;gap:0.5rem;
  font-size:0.75rem;color:var(--gray);
}
.empty-cart{
  grid-column:1/-1;
  text-align:center;
  padding:5rem 2rem;
  background:var(--card);
  border:1px solid var(--border);
  border-radius:var(--radius-lg);
}
.empty-cart .icon{
  font-size:5rem;margin-bottom:1.5rem;
  opacity:0.5;
}
.empty-cart h3{
  font-family:var(--font-display);
  font-size:1.5rem;margin-bottom:0.75rem;
}
.empty-cart p{color:var(--gray);margin-bottom:2rem}

/* ════════════════════════════════════════
   CHECKOUT PAGE
════════════════════════════════════════ */
.checkout-layout{
  padding:3rem 6%;
  display:grid;
  grid-template-columns:1fr 420px;
  gap:3rem;
  align-items:start;
}
.checkout-steps{
  display:flex;align-items:center;
  justify-content:center;gap:2rem;
  margin-bottom:3rem;
}
.checkout-step{
  display:flex;align-items:center;gap:0.75rem;
}
.step-number{
  width:32px;height:32px;
  background:var(--card);
  border:1px solid var(--border);
  border-radius:50%;
  display:flex;align-items:center;justify-content:center;
  font-size:0.8rem;font-weight:600;
}
.checkout-step.active .step-number{
  background:var(--gold);
  border-color:var(--gold);
  color:var(--black);
}
.checkout-step.completed .step-number{
  background:var(--green);
  border-color:var(--green);
  color:var(--white);
}
.step-text{
  font-size:0.85rem;color:var(--gray);
}
.checkout-step.active .step-text{color:var(--white)}
.step-line{
  width:60px;height:1px;
  background:var(--border);
}
.checkout-form-box{
  background:var(--card);
  border:1px solid var(--border);
  border-radius:var(--radius-lg);
  padding:2.5rem;
  margin-bottom:2rem;
}
.form-section-title{
  font-size:0.8rem;letter-spacing:0.15em;
  text-transform:uppercase;color:var(--gold);
  margin-bottom:2rem;
  padding-bottom:1rem;
  border-bottom:1px solid var(--border);
  display:flex;align-items:center;gap:0.75rem;
}
.form-section-title::before{
  content:'';width:4px;height:20px;
  background:var(--gold);border-radius:2px;
}
.form-grid{
  display:grid;
  grid-template-columns:1fr 1fr;
  gap:1.25rem;
}
.form-grid.full{grid-template-columns:1fr}
.form-group{display:flex;flex-direction:column;gap:0.5rem}
.form-group.full{grid-column:1/-1}
.form-group label{
  font-size:0.75rem;letter-spacing:0.1em;
  text-transform:uppercase;color:var(--gray);
}
.form-group input,
.form-group select,
.form-group textarea{
  background:var(--dark3);
  border:1px solid var(--border);
  color:var(--white);
  padding:1rem 1.25rem;
  border-radius:var(--radius);
  font-size:0.95rem;
}
.form-group input:focus,
.form-group select:focus{
  border-color:var(--gold);
  box-shadow:0 0 0 3px rgba(212,175,55,0.1);
}
.form-group select option{background:var(--dark)}
.form-group textarea{resize:vertical;min-height:100px}
.form-group .error-msg{
  color:var(--red);font-size:0.78rem;
  display:none;
}
.form-group.invalid input,
.form-group.invalid select{border-color:var(--red)}
.form-group.invalid .error-msg{display:block}
.payment-options{display:flex;flex-direction:column;gap:1rem}
.payment-option{
  display:flex;align-items:center;gap:1.25rem;
  background:var(--dark3);
  border:1px solid var(--border);
  border-radius:var(--radius);
  padding:1.25rem 1.5rem;
  cursor:pointer;transition:var(--transition);
}
.payment-option:hover{border-color:var(--gold)}
.payment-option.selected,.payment-option:has(input:checked){
  border-color:var(--gold);
  background:rgba(212,175,55,0.05);
}
.payment-option input{accent-color:var(--gold)}
.payment-icon{font-size:1.5rem}
.payment-info{flex:1}
.payment-label{font-weight:500;margin-bottom:0.2rem}
.payment-desc{font-size:0.8rem;color:var(--gray)}
.order-summary-side{position:sticky;top:100px}
.order-items{margin-bottom:1.5rem}
.order-item{
  display:flex;align-items:center;gap:1rem;
  padding:1rem 0;
  border-bottom:1px solid var(--border);
}
.order-item:last-child{border-bottom:none}
.order-item-img{
  width:60px;height:60px;
  background:var(--dark3);
  border-radius:var(--radius-sm);
  display:flex;align-items:center;justify-content:center;
  font-size:1.5rem;flex-shrink:0;
}
.order-item-info{flex:1}
.order-item-name{font-size:0.9rem;margin-bottom:0.2rem}
.order-item-meta{font-size:0.78rem;color:var(--gray)}
.order-item-price{
  font-family:var(--font-display);
  color:var(--gold);font-weight:600;
}

/* ════════════════════════════════════════
   AUTH PAGES
════════════════════════════════════════ */
.auth-page{
  min-height:100vh;
  display:flex;align-items:center;justify-content:center;
  background:var(--black);
  padding:2rem;
  position:relative;
}
.auth-page::before{
  content:'';position:absolute;inset:0;
  background:
    radial-gradient(ellipse at 30% 30%,rgba(212,175,55,0.08),transparent 50%),
    radial-gradient(ellipse at 70% 70%,rgba(212,175,55,0.05),transparent 50%);
}
.auth-card{
  background:var(--card);
  border:1px solid var(--border);
  border-radius:var(--radius-xl);
  padding:3.5rem;
  width:100%;max-width:480px;
  box-shadow:var(--shadow-lg);
  position:relative;z-index:1;
}
.auth-header{text-align:center;margin-bottom:3rem}
.auth-logo{
  font-family:var(--font-display);
  font-size:2rem;letter-spacing:0.2em;
  background:linear-gradient(135deg,var(--gold2),var(--gold));
  -webkit-background-clip:text;
  -webkit-text-fill-color:transparent;
  background-clip:text;
  margin-bottom:0.75rem;
}
.auth-subtitle{color:var(--gray);font-size:0.95rem}
.auth-form{display:flex;flex-direction:column;gap:1.5rem}
.auth-input-group{position:relative}
.auth-input-group input{
  width:100%;
  background:var(--dark3);
  border:1px solid var(--border);
  color:var(--white);
  padding:1rem 1.25rem 1rem 3rem;
  border-radius:var(--radius);
  font-size:0.95rem;
}
.auth-input-group input:focus{
  border-color:var(--gold);
  box-shadow:0 0 0 3px rgba(212,175,55,0.1);
}
.auth-input-group .icon{
  position:absolute;left:1rem;top:50%;
  transform:translateY(-50%);
  color:var(--gray);font-size:1rem;
}
.auth-options{
  display:flex;justify-content:space-between;
  align-items:center;
}
.auth-remember{
  display:flex;align-items:center;gap:0.5rem;
  font-size:0.88rem;color:var(--gray);
}
.auth-remember input{accent-color:var(--gold)}
.auth-forgot{
  font-size:0.88rem;color:var(--gold);
}
.auth-forgot:hover{text-decoration:underline}
.auth-divider{
  text-align:center;color:var(--gray);
  font-size:0.82rem;position:relative;
  margin:0.5rem 0;
}
.auth-divider::before,.auth-divider::after{
  content:'';position:absolute;top:50%;
  width:40%;height:1px;
  background:var(--border);
}
.auth-divider::before{left:0}
.auth-divider::after{right:0}
.auth-social{display:flex;gap:1rem}
.auth-social-btn{
  flex:1;
  display:flex;align-items:center;justify-content:center;gap:0.75rem;
  padding:0.9rem;
  background:var(--dark3);
  border:1px solid var(--border);
  border-radius:var(--radius);
  font-size:0.85rem;color:var(--white);
  transition:var(--transition);
}
.auth-social-btn:hover{border-color:var(--gold)}
.auth-footer{
  text-align:center;margin-top:2rem;
  font-size:0.9rem;color:var(--gray);
}
.auth-footer a{color:var(--gold)}
.auth-footer a:hover{text-decoration:underline}

/* ════════════════════════════════════════
   ADMIN PANEL
════════════════════════════════════════ */
.admin-layout{
  display:grid;
  grid-template-columns:260px 1fr;
  min-height:100vh;
}
.admin-sidebar{
  background:var(--black);
  border-right:1px solid var(--border);
  position:sticky;top:0;height:100vh;
  overflow-y:auto;
}
.admin-logo{
  padding:2rem;
  font-family:var(--font-display);
  font-size:1.3rem;letter-spacing:0.15em;
  background:linear-gradient(135deg,var(--gold2),var(--gold));
  -webkit-background-clip:text;
  -webkit-text-fill-color:transparent;
  background-clip:text;
  border-bottom:1px solid var(--border);
}
.admin-nav{padding:1.5rem 0}
.admin-nav-item{
  display:flex;align-items:center;gap:1rem;
  padding:1rem 2rem;
  font-size:0.88rem;color:var(--gray);
  cursor:pointer;transition:var(--transition);
  border-left:3px solid transparent;
}
.admin-nav-item:hover{
  color:var(--white);
  background:rgba(255,255,255,0.03);
}
.admin-nav-item.active{
  color:var(--gold);
  background:rgba(212,175,55,0.08);
  border-left-color:var(--gold);
}
.admin-nav-icon{font-size:1.2rem;width:24px;text-align:center}
.admin-content{
  background:var(--dark);
  padding:2rem 3rem;
  overflow:auto;
}
.admin-header{
  display:flex;align-items:center;
  justify-content:space-between;
  margin-bottom:2.5rem;
}
.admin-header h1{
  font-family:var(--font-display);
  font-size:1.8rem;
}
.admin-header-right{
  display:flex;align-items:center;gap:1rem;
}
.admin-search{
  display:flex;align-items:center;gap:0.5rem;
  background:var(--card);
  border:1px solid var(--border);
  border-radius:var(--radius);
  padding:0.6rem 1rem;
}
.admin-search input{
  background:none;border:none;
  color:var(--white);font-size:0.88rem;
  width:200px;
}
.admin-search input::placeholder{color:var(--gray)}
.admin-user{
  display:flex;align-items:center;gap:0.75rem;
  padding:0.5rem 1rem;
  background:var(--card);
  border:1px solid var(--border);
  border-radius:var(--radius);
}
.admin-avatar{
  width:36px;height:36px;
  background:linear-gradient(135deg,var(--gold),var(--gold3));
  border-radius:50%;
  display:flex;align-items:center;justify-content:center;
  font-weight:600;color:var(--black);
}
.admin-stats{
  display:grid;
  grid-template-columns:repeat(4,1fr);
  gap:1.5rem;margin-bottom:2.5rem;
}
.admin-stat{
  background:var(--card);
  border:1px solid var(--border);
  border-radius:var(--radius-lg);
  padding:1.75rem;
  transition:var(--transition);
}
.admin-stat:hover{border-color:var(--gold)}
.admin-stat-icon{
  width:48px;height:48px;
  background:rgba(212,175,55,0.1);
  border-radius:var(--radius);
  display:flex;align-items:center;justify-content:center;
  font-size:1.5rem;margin-bottom:1rem;
}
.admin-stat-value{
  font-family:var(--font-display);
  font-size:2rem;font-weight:600;
  color:var(--gold);margin-bottom:0.25rem;
}
.admin-stat-label{
  font-size:0.78rem;letter-spacing:0.1em;
  text-transform:uppercase;color:var(--gray);
}
.admin-stat-change{
  display:flex;align-items:center;gap:0.3rem;
  font-size:0.82rem;color:var(--green);
  margin-top:0.5rem;
}
.admin-stat-change.negative{color:var(--red)}
.admin-section{
  background:var(--card);
  border:1px solid var(--border);
  border-radius:var(--radius-lg);
  overflow:hidden;margin-bottom:2rem;
}
.admin-section-head{
  padding:1.25rem 1.75rem;
  display:flex;align-items:center;
  justify-content:space-between;
  border-bottom:1px solid var(--border);
}
.admin-section-head h3{
  font-size:1rem;display:flex;
  align-items:center;gap:0.75rem;
}
.data-table{width:100%;border-collapse:collapse}
.data-table th{
  padding:1rem 1.5rem;text-align:left;
  font-size:0.7rem;letter-spacing:0.12em;
  text-transform:uppercase;color:var(--gray);
  background:var(--dark3);
  border-bottom:1px solid var(--border);
}
.data-table td{
  padding:1.25rem 1.5rem;font-size:0.9rem;
  border-bottom:1px solid var(--border);
}
.data-table tr:last-child td{border-bottom:none}
.data-table tr:hover td{background:rgba(255,255,255,0.02)}
.status-badge{
  display:inline-flex;align-items:center;gap:0.4rem;
  padding:0.3rem 0.9rem;border-radius:50px;
  font-size:0.72rem;font-weight:600;
  letter-spacing:0.06em;text-transform:uppercase;
}
.status-badge::before{
  content:'';width:6px;height:6px;
  border-radius:50%;
}
.status-pending{background:rgba(255,165,0,0.12);color:#ffa500}
.status-pending::before{background:#ffa500}
.status-processing{background:rgba(55,66,250,0.12);color:#5c6cff}
.status-processing::before{background:#5c6cff}
.status-shipped{background:rgba(46,213,115,0.12);color:var(--green)}
.status-shipped::before{background:var(--green)}
.status-delivered{background:rgba(212,175,55,0.12);color:var(--gold)}
.status-delivered::before{background:var(--gold)}
.status-cancelled{background:rgba(255,71,87,0.12);color:var(--red)}
.status-cancelled::before{background:var(--red)}
.table-actions{display:flex;gap:0.5rem}
.action-btn{
  padding:0.4rem 0.9rem;border-radius:6px;
  font-size:0.72rem;font-weight:600;
  letter-spacing:0.06em;text-transform:uppercase;
  cursor:pointer;transition:var(--transition);border:none;
}
.action-edit{background:rgba(55,66,250,0.12);color:#5c6cff}
.action-edit:hover{background:rgba(55,66,250,0.25)}
.action-view{background:rgba(212,175,55,0.12);color:var(--gold)}
.action-view:hover{background:rgba(212,175,55,0.25)}
.action-del{background:rgba(255,71,87,0.12);color:var(--red)}
.action-del:hover{background:rgba(255,71,87,0.25)}

/* ════════════════════════════════════════
   MODALS
════════════════════════════════════════ */
.modal-overlay{
  position:fixed;inset:0;
  background:rgba(0,0,0,0.85);
  backdrop-filter:blur(5px);
  z-index:2000;
  display:flex;align-items:center;justify-content:center;
  padding:2rem;
  opacity:0;pointer-events:none;
  transition:var(--transition);
}
.modal-overlay.open{opacity:1;pointer-events:all}
.modal{
  background:var(--card);
  border:1px solid var(--border);
  border-radius:var(--radius-xl);
  padding:2.5rem;
  width:100%;max-width:550px;
  box-shadow:var(--shadow-lg);
  transform:scale(0.9) translateY(20px);
  transition:var(--transition);
}
.modal-overlay.open .modal{transform:scale(1) translateY(0)}
.modal-head{
  display:flex;align-items:center;
  justify-content:space-between;
  margin-bottom:2rem;
}
.modal-head h3{
  font-family:var(--font-display);
  font-size:1.3rem;
}
.modal-close{
  background:var(--dark3);
  border:1px solid var(--border);
  color:var(--gray);
  width:40px;height:40px;
  border-radius:50%;
  display:flex;align-items:center;justify-content:center;
  font-size:1.2rem;
  transition:var(--transition);
}
.modal-close:hover{
  border-color:var(--red);
  color:var(--red);
}

/* Success Modal */
.success-modal{text-align:center;max-width:450px}
.success-icon{
  width:100px;height:100px;
  background:linear-gradient(135deg,rgba(46,213,115,0.2),rgba(46,213,115,0.1));
  border-radius:50%;margin:0 auto 2rem;
  display:flex;align-items:center;justify-content:center;
  font-size:3rem;
  animation:successPop 0.5s ease;
}
@keyframes successPop{
  0%{transform:scale(0)}
  50%{transform:scale(1.2)}
  100%{transform:scale(1)}
}
.success-modal h3{
  font-family:var(--font-display);
  font-size:1.75rem;margin-bottom:1rem;
}
.success-modal p{
  color:var(--gray);margin-bottom:2rem;
  line-height:1.7;
}
.order-id-box{
  background:var(--dark3);
  border:1px solid var(--border);
  border-radius:var(--radius);
  padding:1.25rem;margin-bottom:2rem;
}
.order-id-label{
  font-size:0.75rem;color:var(--gray);
  letter-spacing:0.1em;text-transform:uppercase;
  margin-bottom:0.3rem;
}
.order-id-value{
  font-family:var(--font-display);
  font-size:1.5rem;color:var(--gold);
  font-weight:600;
}

/* ════════════════════════════════════════
   TOAST NOTIFICATIONS
════════════════════════════════════════ */
.toast-container{
  position:fixed;bottom:2rem;right:2rem;
  z-index:9999;
  display:flex;flex-direction:column;gap:0.75rem;
}
.toast{
  background:var(--card);
  border:1px solid var(--border);
  border-radius:var(--radius);
  padding:1rem 1.5rem;
  display:flex;align-items:center;gap:1rem;
  min-width:320px;
  box-shadow:var(--shadow-lg);
  animation:toastIn 0.4s ease;
}
.toast.out{animation:toastOut 0.3s ease forwards}
@keyframes toastIn{
  from{transform:translateX(120%);opacity:0}
  to{transform:translateX(0);opacity:1}
}
@keyframes toastOut{
  to{transform:translateX(120%);opacity:0}
}
.toast-icon{
  width:36px;height:36px;
  border-radius:50%;
  display:flex;align-items:center;justify-content:center;
  font-size:1rem;flex-shrink:0;
}
.toast.success .toast-icon{background:rgba(46,213,115,0.15);color:var(--green)}
.toast.error .toast-icon{background:rgba(255,71,87,0.15);color:var(--red)}
.toast.info .toast-icon{background:rgba(212,175,55,0.15);color:var(--gold)}
.toast-content{flex:1}
.toast-title{font-weight:600;font-size:0.9rem;margin-bottom:0.15rem}
.toast-msg{font-size:0.82rem;color:var(--gray)}
.toast-close{
  background:none;color:var(--gray);
  padding:0.25rem;cursor:pointer;
  transition:var(--transition);
}
.toast-close:hover{color:var(--white)}
.toast-progress{
  position:absolute;bottom:0;left:0;right:0;
  height:3px;background:var(--border);
  border-radius:0 0 var(--radius) var(--radius);
  overflow:hidden;
}
.toast-progress-bar{
  height:100%;
  animation:toastProgress 3s linear forwards;
}
.toast.success .toast-progress-bar{background:var(--green)}
.toast.error .toast-progress-bar{background:var(--red)}
.toast.info .toast-progress-bar{background:var(--gold)}
@keyframes toastProgress{from{width:100%}to{width:0}}

/* ════════════════════════════════════════
   WISHLIST SIDEBAR
════════════════════════════════════════ */
.wishlist-sidebar{
  position:fixed;top:0;right:0;bottom:0;
  width:400px;max-width:100%;
  background:var(--card);
  border-left:1px solid var(--border);
  z-index:2000;
  transform:translateX(100%);
  transition:var(--transition-slow);
  display:flex;flex-direction:column;
}
.wishlist-sidebar.open{transform:translateX(0)}
.wishlist-overlay{
  position:fixed;inset:0;
  background:rgba(0,0,0,0.6);
  z-index:1999;
  opacity:0;pointer-events:none;
  transition:var(--transition);
}
.wishlist-overlay.open{opacity:1;pointer-events:all}
.wishlist-header{
  padding:1.5rem 2rem;
  border-bottom:1px solid var(--border);
  display:flex;align-items:center;
  justify-content:space-between;
}
.wishlist-header h3{
  font-family:var(--font-display);
  font-size:1.2rem;
}
.wishlist-items{
  flex:1;overflow-y:auto;padding:1.5rem 2rem;
}
.wishlist-item{
  display:flex;gap:1rem;
  padding:1rem 0;
  border-bottom:1px solid var(--border);
}
.wishlist-item-img{
  width:70px;height:70px;
  background:var(--dark3);
  border-radius:var(--radius-sm);
  display:flex;align-items:center;justify-content:center;
  font-size:1.5rem;flex-shrink:0;
}
.wishlist-item-info{flex:1}
.wishlist-item-name{font-size:0.9rem;margin-bottom:0.25rem}
.wishlist-item-price{color:var(--gold);font-weight:600}
.wishlist-item-actions{
  display:flex;flex-direction:column;
  gap:0.5rem;justify-content:center;
}
.wishlist-footer{
  padding:1.5rem 2rem;
  border-top:1px solid var(--border);
}

/* ════════════════════════════════════════
   RESPONSIVE
════════════════════════════════════════ */
@media(max-width:1200px){
  .hero-visual{display:none}
  .categories-grid{grid-template-columns:repeat(3,1fr)}
  .testimonials-grid{grid-template-columns:1fr}
  .footer-top{grid-template-columns:1fr 1fr 1fr}
  .admin-stats{grid-template-columns:repeat(2,1fr)}
}
@media(max-width:1024px){
  .shop-layout{grid-template-columns:1fr}
  .filters-sidebar{display:none}
  .product-detail{grid-template-columns:1fr;gap:2rem}
  .cart-layout,.checkout-layout{grid-template-columns:1fr}
  .admin-layout{grid-template-columns:1fr}
  .admin-sidebar{display:none}
  .footer-top{grid-template-columns:1fr 1fr}
  .promo-section{grid-template-columns:1fr;padding:3rem}
  .promo-visual{display:none}
}
@media(max-width:768px){
  .navbar{height:70px;padding:0 5%}
  .nav-links,.nav-auth-btns{display:none}
  .hamburger{display:flex}
  .mobile-menu{display:block}
  .hero{min-height:auto;padding:120px 5% 60px}
  .hero h1{font-size:2.5rem}
  .hero-features{flex-direction:column;gap:1.5rem}
  .scroll-indicator{display:none}
  .section{padding:4rem 5%}
  .stats-grid{grid-template-columns:1fr 1fr}
  .categories-grid{grid-template-columns:repeat(2,1fr)}
  .products-grid{grid-template-columns:1fr}
  .cart-header{display:none}
  .cart-row{
    grid-template-columns:1fr;
    gap:1rem;padding:1.5rem;
    position:relative;
  }
  .cart-row .cart-remove{position:absolute;top:1rem;right:1rem}
  .detail-features{grid-template-columns:1fr}
  .checkout-steps{flex-wrap:wrap}
  .step-line{display:none}
  .form-grid{grid-template-columns:1fr}
  .brands-grid{justify-content:center}
  .newsletter-form{flex-direction:column}
  .footer-top{grid-template-columns:1fr;gap:2rem}
  .footer-bottom{flex-direction:column;text-align:center}
  .cursor,.cursor-dot{display:none}
  .wishlist-sidebar{width:100%}
}
@media(max-width:480px){
  .hero h1{font-size:2rem}
  .hero-btns{flex-direction:column}
  .hero-btns .btn{width:100%}
  .stat-item{padding:1.5rem}
  .stat-number{font-size:2rem}
  .categories-grid{grid-template-columns:1fr}
  .countdown{flex-wrap:wrap;justify-content:center}
  .auth-card{padding:2rem}
}

/* ════════════════════════════════════════
   UTILITY CLASSES
════════════════════════════════════════ */
.text-gold{color:var(--gold)}
.text-gray{color:var(--gray)}
.text-green{color:var(--green)}
.text-red{color:var(--red)}
.mt-1{margin-top:0.5rem}
.mt-2{margin-top:1rem}
.mt-3{margin-top:1.5rem}
.mb-1{margin-bottom:0.5rem}
.mb-2{margin-bottom:1rem}
.mb-3{margin-bottom:1.5rem}
.flex{display:flex}
.items-center{align-items:center}
.justify-center{justify-content:center}
.justify-between{justify-content:space-between}
.gap-1{gap:0.5rem}
.gap-2{gap:1rem}
.gap-3{gap:1.5rem}
.w-full{width:100%}
.text-center{text-align:center}
.hidden{display:none!important}

/* Animations */
.fade-in{animation:fadeIn 0.6s ease}
@keyframes fadeIn{from{opacity:0}to{opacity:1}}
.slide-up{animation:slideUp 0.6s ease}
@keyframes slideUp{from{opacity:0;transform:translateY(30px)}to{opacity:1;transform:translateY(0)}}
.scale-in{animation:scaleIn 0.4s ease}
@keyframes scaleIn{from{transform:scale(0.9);opacity:0}to{transform:scale(1);opacity:1}}

/* Intersection Observer Animations */
[data-animate]{opacity:0;transform:translateY(30px);transition:all 0.8s cubic-bezier(0.4,0,0.2,1)}
[data-animate].animated{opacity:1;transform:translateY(0)}
[data-animate="fade"]{transform:none}
[data-animate="scale"]{transform:scale(0.95)}
[data-animate="scale"].animated{transform:scale(1)}
</style>
</head>
<body>

<!-- Loading Screen -->
<div class="loading-screen" id="loading-screen">
  <div class="loading-logo">LUXE</div>
  <div class="loading-bar"></div>
</div>

<!-- Custom Cursor -->
<div class="cursor" id="cursor"></div>
<div class="cursor-dot" id="cursor-dot"></div>

<!-- ════════════════════════════════════════
     NAVBAR
════════════════════════════════════════ -->
<nav class="navbar" id="navbar">
  <div class="nav-logo nav-btn" data-page="home" style="cursor:pointer">LUXE</div>
  <div class="nav-links">
    <a class="nav-link nav-btn" data-page="home">Home</a>
    <a class="nav-link nav-btn" data-page="shop">Shop</a>
    <a class="nav-link" href="#">Collections</a>
    <a class="nav-link" href="#">About</a>
    <a class="nav-link" href="#">Contact</a>
  </div>
  <div class="nav-right">
    <button class="nav-icon-btn" onclick="toggleWishlist()" title="Wishlist">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
    </button>
    <button class="nav-icon-btn nav-btn" data-page="cart" title="Cart">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M9 22a1 1 0 1 0 0-2 1 1 0 0 0 0 2zM20 22a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
      <span class="cart-count" id="cart-count">0</span>
    </button>
    <button class="nav-icon-btn nav-btn" data-page="login" title="Account">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
    </button>
    <div class="nav-auth-btns">
      <button class="nav-auth-btn outline nav-btn" data-page="login">Login</button>
      <button class="nav-auth-btn filled nav-btn" data-page="register">Register</button>
    </div>
    <button class="hamburger" id="hamburger-btn" aria-label="Menu">
      <span></span><span></span><span></span>
    </button>
  </div>
</nav>

<!-- Mobile Menu -->
<div class="mobile-menu" id="mobile-menu">
  <a class="nav-btn mob-nav" data-page="home">🏠 Home</a>
  <a class="nav-btn mob-nav" data-page="shop">🛍️ Shop</a>
  <a href="#">✨ Collections</a>
  <a class="nav-btn mob-nav" data-page="cart">🛒 Cart</a>
  <a class="nav-btn mob-nav" data-page="checkout">💳 Checkout</a>
  <a class="nav-btn mob-nav" data-page="login">🔐 Login</a>
  <a class="nav-btn mob-nav" data-page="register">📝 Register</a>
  <div class="mobile-menu-footer">
    <button class="btn btn-gold w-full nav-btn" data-page="shop">Shop Now</button>
  </div>
</div>

<!-- Wishlist Sidebar -->
<div class="wishlist-overlay" id="wishlist-overlay" onclick="toggleWishlist()"></div>
<div class="wishlist-sidebar" id="wishlist-sidebar">
  <div class="wishlist-header">
    <h3>💖 Wishlist</h3>
    <button class="modal-close" onclick="toggleWishlist()">✕</button>
  </div>
  <div class="wishlist-items" id="wishlist-items">
    <div class="empty-cart" style="padding:2rem">
      <div class="icon">💔</div>
      <h3>Your wishlist is empty</h3>
      <p>Save items you love for later</p>
    </div>
  </div>
  <div class="wishlist-footer">
    <button class="btn btn-gold w-full" onclick="toggleWishlist();showPage('shop')">Continue Shopping</button>
  </div>
</div>

<!-- Back to Top -->
<button class="back-to-top" id="back-to-top" onclick="window.scrollTo({top:0,behavior:'smooth'})">↑</button>

<!-- ════════════════════════════════════════
     HOME PAGE
════════════════════════════════════════ -->
<div class="page active" id="page-home">

  <!-- Hero Section -->
  <section class="hero">
    <div class="hero-bg"></div>
    <div class="hero-pattern"></div>
    <div class="hero-content">
      <div class="hero-badge">
        <div class="hero-badge-dot"></div>
        <span class="hero-badge-text">New Collection 2025</span>
      </div>
      <h1>Discover <span class="highlight">Luxury</span><br>Redefined for <span class="italic">You</span></h1>
      <p class="hero-desc">Experience the pinnacle of craftsmanship with our curated collection of premium products. Each piece tells a story of excellence.</p>
      <div class="hero-btns">
        <button class="btn btn-gold btn-lg" onclick="showPage('shop')">
          <span>Explore Collection</span>
          <span>→</span>
        </button>
        <button class="btn btn-outline btn-lg" onclick="showPage('shop')">View Catalog</button>
      </div>
      <div class="hero-features">
        <div class="hero-feature">
          <div class="hero-feature-icon">🚚</div>
          <span class="hero-feature-text">Free Shipping $100+</span>
        </div>
        <div class="hero-feature">
          <div class="hero-feature-icon">🔒</div>
          <span class="hero-feature-text">Secure Payments</span>
        </div>
        <div class="hero-feature">
          <div class="hero-feature-icon">↩️</div>
          <span class="hero-feature-text">30-Day Returns</span>
        </div>
      </div>
    </div>
    <div class="hero-visual">
      <div class="hero-card">
        <div class="hero-floating-badge">Best Seller</div>
        <div class="hero-card-img">👑</div>
        <div class="hero-card-info">
          <div class="hero-card-details">
            <span class="category">Watches</span>
            <h3>Luminara Gold Watch</h3>
          </div>
          <div class="hero-card-price">$1,299</div>
        </div>
      </div>
    </div>
    <div class="scroll-indicator">
      <div class="scroll-mouse"></div>
      <span>Scroll to explore</span>
    </div>
  </section>

  <!-- Marquee -->
  <div class="marquee-section">
    <div class="marquee">
      <div class="marquee-content">
        <div class="marquee-item"><span>✦</span> Premium Quality</div>
        <div class="marquee-item"><span>✦</span> Worldwide Shipping</div>
        <div class="marquee-item"><span>✦</span> Authentic Products</div>
        <div class="marquee-item"><span>✦</span> Secure Checkout</div>
        <div class="marquee-item"><span>✦</span> 24/7 Support</div>
        <div class="marquee-item"><span>✦</span> Easy Returns</div>
        <div class="marquee-item"><span>✦</span> Premium Quality</div>
        <div class="marquee-item"><span>✦</span> Worldwide Shipping</div>
      </div>
      <div class="marquee-content" aria-hidden="true">
        <div class="marquee-item"><span>✦</span> Premium Quality</div>
        <div class="marquee-item"><span>✦</span> Worldwide Shipping</div>
        <div class="marquee-item"><span>✦</span> Authentic Products</div>
        <div class="marquee-item"><span>✦</span> Secure Checkout</div>
        <div class="marquee-item"><span>✦</span> 24/7 Support</div>
        <div class="marquee-item"><span>✦</span> Easy Returns</div>
        <div class="marquee-item"><span>✦</span> Premium Quality</div>
        <div class="marquee-item"><span>✦</span> Worldwide Shipping</div>
      </div>
    </div>
  </div>

  <!-- Stats Section -->
  <section class="stats-section" data-animate>
    <div class="stats-grid">
      <div class="stat-item">
        <div class="stat-number" data-count="50000">50K+</div>
        <div class="stat-label">Happy Customers</div>
      </div>
      <div class="stat-item">
        <div class="stat-number">2K+</div>
        <div class="stat-label">Premium Products</div>
      </div>
      <div class="stat-item">
        <div class="stat-number">120+</div>
        <div class="stat-label">Global Brands</div>
      </div>
      <div class="stat-item">
        <div class="stat-number">4.9★</div>
        <div class="stat-label">Average Rating</div>
      </div>
    </div>
  </section>

  <!-- Categories Section -->
  <section class="section">
    <div class="section-header" data-animate>
      <div class="section-tag">Browse</div>
      <h2 class="section-title">Shop by <span class="highlight">Category</span></h2>
      <p class="section-sub">Explore our curated categories to find exactly what you're looking for</p>
    </div>
    <div class="categories-grid" data-animate>
      <div class="category-card" onclick="filterCategory('Electronics')">
        <span class="category-icon">📱</span>
        <div class="category-name">Electronics</div>
        <div class="category-count">142 items</div>
      </div>
      <div class="category-card" onclick="filterCategory('Fashion')">
        <span class="category-icon">👗</span>
        <div class="category-name">Fashion</div>
        <div class="category-count">389 items</div>
      </div>
      <div class="category-card" onclick="filterCategory('Watches')">
        <span class="category-icon">⌚</span>
        <div class="category-name">Watches</div>
        <div class="category-count">76 items</div>
      </div>
      <div class="category-card" onclick="filterCategory('Jewelry')">
        <span class="category-icon">💎</span>
        <div class="category-name">Jewelry</div>
        <div class="category-count">203 items</div>
      </div>
      <div class="category-card" onclick="filterCategory('Home')">
        <span class="category-icon">🏠</span>
        <div class="category-name">Home & Living</div>
        <div class="category-count">155 items</div>
      </div>
      <div class="category-card" onclick="filterCategory('Beauty')">
        <span class="category-icon">✨</span>
        <div class="category-name">Beauty</div>
        <div class="category-count">98 items</div>
      </div>
    </div>
  </section>

  <!-- Featured Products -->
  <section class="section section-dark">
    <div class="section-header" data-animate>
      <div class="section-tag">Curated</div>
      <h2 class="section-title">Featured <span class="highlight">Products</span></h2>
      <p class="section-sub">Hand-picked premium items selected just for you</p>
    </div>
    <div class="products-grid" id="featured-products" data-animate></div>
    <div style="text-align:center;margin-top:3rem" data-animate>
      <button class="btn btn-outline btn-lg" onclick="showPage('shop')">View All Products →</button>
    </div>
  </section>

  <!-- Promo Section -->
  <section class="section">
    <div class="promo-section" data-animate>
      <div class="promo-content">
        <div class="promo-tag">🔥 Limited Time Offer</div>
        <h2>Up to <span class="gold">40% Off</span><br>Premium Collection</h2>
        <p>Don't miss our biggest sale of the season. Shop premium quality at unbeatable prices. Limited stock available.</p>
        <div class="promo-features">
          <div class="promo-feature">
            <div class="promo-feature-icon">✓</div>
            <span>Free worldwide shipping on orders $100+</span>
          </div>
          <div class="promo-feature">
            <div class="promo-feature-icon">✓</div>
            <span>30-day hassle-free returns</span>
          </div>
          <div class="promo-feature">
            <div class="promo-feature-icon">✓</div>
            <span>Authentic products, guaranteed</span>
          </div>
        </div>
        <div class="countdown" id="countdown">
          <div class="countdown-item">
            <span class="countdown-value" id="days">02</span>
            <span class="countdown-label">Days</span>
          </div>
          <div class="countdown-item">
            <span class="countdown-value" id="hours">18</span>
            <span class="countdown-label">Hours</span>
          </div>
          <div class="countdown-item">
            <span class="countdown-value" id="minutes">45</span>
            <span class="countdown-label">Min</span>
          </div>
          <div class="countdown-item">
            <span class="countdown-value" id="seconds">30</span>
            <span class="countdown-label">Sec</span>
          </div>
        </div>
        <button class="btn btn-gold btn-lg mt-3" onclick="showPage('shop')">Shop the Sale →</button>
      </div>
      <div class="promo-visual">🎁</div>
    </div>
  </section>

  <!-- Testimonials -->
  <section class="testimonials-section">
    <div class="section-header" data-animate>
      <div class="section-tag">Testimonials</div>
      <h2 class="section-title">What Our <span class="highlight">Customers</span> Say</h2>
      <p class="section-sub">Real experiences from our valued customers</p>
    </div>
    <div class="testimonials-grid" data-animate>
      <div class="testimonial-card">
        <div class="testimonial-quote">"</div>
        <div class="testimonial-rating">
          <span class="star">★</span><span class="star">★</span><span class="star">★</span><span class="star">★</span><span class="star">★</span>
        </div>
        <p class="testimonial-text">Absolutely stunning quality. The packaging alone was impressive, and the product exceeded my expectations. Will definitely purchase again.</p>
        <div class="testimonial-author">
          <div class="testimonial-avatar">AM</div>
          <div class="testimonial-info">
            <h4>Alexandra M.</h4>
            <p>Verified Buyer</p>
          </div>
        </div>
      </div>
      <div class="testimonial-card">
        <div class="testimonial-quote">"</div>
        <div class="testimonial-rating">
          <span class="star">★</span><span class="star">★</span><span class="star">★</span><span class="star">★</span><span class="star">★</span>
        </div>
        <p class="testimonial-text">Fast shipping and excellent customer service. The watch I ordered was exactly as pictured. LUXE has become my go-to for luxury items.</p>
        <div class="testimonial-author">
          <div class="testimonial-avatar">JT</div>
          <div class="testimonial-info">
            <h4>James T.</h4>
            <p>Verified Buyer</p>
          </div>
        </div>
      </div>
      <div class="testimonial-card">
        <div class="testimonial-quote">"</div>
        <div class="testimonial-rating">
          <span class="star">★</span><span class="star">★</span><span class="star">★</span><span class="star">★</span><span class="star">★</span>
        </div>
        <p class="testimonial-text">I bought this as a gift and the recipient was overjoyed. Beautiful, high-quality, and arrived perfectly packaged. Highly recommend!</p>
        <div class="testimonial-author">
          <div class="testimonial-avatar">SR</div>
          <div class="testimonial-info">
            <h4>Sofia R.</h4>
            <p>Verified Buyer</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Brands -->
  <section class="brands-section">
    <div class="brands-grid">
      <div class="brand-item">ROLEX</div>
      <div class="brand-item">GUCCI</div>
      <div class="brand-item">PRADA</div>
      <div class="brand-item">CARTIER</div>
      <div class="brand-item">VERSACE</div>
      <div class="brand-item">DIOR</div>
    </div>
  </section>

  <!-- Newsletter -->
  <section class="newsletter-section">
    <div class="newsletter-content" data-animate>
      <h2>Stay in the Loop</h2>
      <p>Subscribe to our newsletter for exclusive offers, new arrivals, and style inspiration.</p>
      <form class="newsletter-form" onsubmit="handleNewsletter(event)">
        <input type="email" class="newsletter-input" placeholder="Enter your email address" required/>
        <button type="submit" class="btn btn-gold">Subscribe</button>
      </form>
    </div>
  </section>

  <!-- Footer -->
  <footer>
    <div class="footer-top">
      <div class="footer-brand">
        <div class="logo">LUXE</div>
        <p>Your destination for premium products and luxury goods. We curate only the finest items for our discerning customers worldwide.</p>
        <div class="social-links">
          <a class="social-btn" title="Facebook">𝖿</a>
          <a class="social-btn" title="Twitter">𝕏</a>
          <a class="social-btn" title="Instagram">📷</a>
          <a class="social-btn" title="Pinterest">𝒫</a>
        </div>
      </div>
      <div class="footer-col">
        <h4>Shop</h4>
        <ul>
          <li><a onclick="showPage('shop')">All Products</a></li>
          <li><a href="#">New Arrivals</a></li>
          <li><a href="#">Best Sellers</a></li>
          <li><a href="#">Sale Items</a></li>
          <li><a href="#">Gift Cards</a></li>
        </ul>
      </div>
      <div class="footer-col">
        <h4>Support</h4>
        <ul>
          <li><a href="#">FAQ</a></li>
          <li><a href="#">Shipping Info</a></li>
          <li><a href="#">Returns & Exchanges</a></li>
          <li><a href="#">Track Order</a></li>
          <li><a href="#">Size Guide</a></li>
        </ul>
      </div>
      <div class="footer-col">
        <h4>Company</h4>
        <ul>
          <li><a href="#">About Us</a></li>
          <li><a href="#">Careers</a></li>
          <li><a href="#">Press</a></li>
          <li><a href="#">Sustainability</a></li>
          <li><a href="#">Affiliates</a></li>
        </ul>
      </div>
      <div class="footer-col">
        <h4>Contact</h4>
        <div class="footer-contact-item">
          <div class="footer-contact-icon">📧</div>
          <div class="footer-contact-text">support@luxe.com</div>
        </div>
        <div class="footer-contact-item">
          <div class="footer-contact-icon">📞</div>
          <div class="footer-contact-text">+1 (800) LUXE-123</div>
        </div>
        <div class="footer-contact-item">
          <div class="footer-contact-icon">💬</div>
          <div class="footer-contact-text">Live Chat Available</div>
        </div>
      </div>
    </div>
    <div class="footer-bottom">
      <p>© 2025 LUXE. All rights reserved.</p>
      <div class="footer-bottom-links">
        <a href="#">Privacy Policy</a>
        <a href="#">Terms of Service</a>
        <a href="#">Cookie Policy</a>
      </div>
      <div class="payment-methods">
        <div class="payment-method">VISA</div>
        <div class="payment-method">MC</div>
        <div class="payment-method">AMEX</div>
        <div class="payment-method">PP</div>
      </div>
    </div>
  </footer>
</div>

<!-- ════════════════════════════════════════
     SHOP PAGE
════════════════════════════════════════ -->
<div class="page" id="page-shop">
  <div class="page-hero">
    <div class="breadcrumb">
      <a onclick="showPage('home')">Home</a>
      <span class="separator">›</span>
      <span>Shop</span>
    </div>
    <h1>All Products</h1>
    <p>Discover our complete collection of premium items</p>
  </div>
  <div class="shop-layout">
    <aside class="filters-sidebar">
      <div class="filter-header">
        <h3>🎛️ Filters</h3>
        <span class="filter-clear" onclick="clearFilters()">Clear All</span>
      </div>
      <div class="filter-group">
        <div class="filter-title">Categories</div>
        <div class="filter-options" id="category-filters"></div>
      </div>
      <div class="filter-group">
        <div class="filter-title">Price Range</div>
        <div class="price-slider">
          <input type="range" id="price-range" min="0" max="3000" value="3000" oninput="filterProducts()"/>
          <div class="price-labels">
            <span>$0</span>
            <span id="price-max-label">$3,000</span>
          </div>
        </div>
      </div>
      <div class="filter-group">
        <div class="filter-title">Rating</div>
        <div class="filter-options">
          <label class="filter-option">
            <input type="radio" name="rating" value="0" checked onchange="filterProducts()"/>
            <label>All Ratings</label>
          </label>
          <label class="filter-option">
            <input type="radio" name="rating" value="4" onchange="filterProducts()"/>
            <label>4★ & above</label>
          </label>
          <label class="filter-option">
            <input type="radio" name="rating" value="3" onchange="filterProducts()"/>
            <label>3★ & above</label>
          </label>
        </div>
      </div>
    </aside>
    <div>
      <div class="shop-header">
        <div class="result-count" id="result-count">Showing all products</div>
        <div class="shop-controls">
          <div class="search-box">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/></svg>
            <input type="text" id="search-input" placeholder="Search products..." oninput="filterProducts()"/>
          </div>
          <select class="sort-select" id="sort-select" onchange="filterProducts()">
            <option value="default">Sort: Default</option>
            <option value="price-low">Price: Low to High</option>
            <option value="price-high">Price: High to Low</option>
            <option value="rating">Highest Rated</option>
            <option value="name">Name: A–Z</option>
          </select>
        </div>
      </div>
      <div class="products-grid" id="shop-products"></div>
    </div>
  </div>
</div>

<!-- ════════════════════════════════════════
     PRODUCT DETAIL PAGE
════════════════════════════════════════ -->
<div class="page" id="page-detail">
  <div class="page-hero" style="padding:120px 6% 40px">
    <div class="breadcrumb">
      <a onclick="showPage('home')">Home</a>
      <span class="separator">›</span>
      <a onclick="showPage('shop')">Shop</a>
      <span class="separator">›</span>
      <span id="detail-breadcrumb">Product</span>
    </div>
  </div>
  <div class="product-detail">
    <div class="detail-gallery">
      <div class="main-img" id="detail-main-img">
        👑
        <div class="img-zoom">🔍</div>
      </div>
      <div class="thumbs" id="detail-thumbs"></div>
    </div>
    <div class="detail-info">
      <div class="detail-badges">
        <span class="detail-badge bestseller">Best Seller</span>
        <span class="detail-badge stock">✓ In Stock</span>
      </div>
      <div class="detail-cat" id="detail-cat">Category</div>
      <h1 class="detail-name" id="detail-name">Product Name</h1>
      <div class="detail-rating">
        <div class="stars" id="detail-stars"></div>
        <div class="rating-summary">
          <span id="detail-rating-value">4.9</span>
          <span id="detail-reviews">(284 reviews)</span>
        </div>
      </div>
      <div class="detail-price">
        <span class="current" id="detail-price">$0.00</span>
        <span class="old" id="detail-old-price"></span>
        <span class="discount" id="detail-discount"></span>
      </div>
      <p class="detail-desc" id="detail-desc">Product description goes here.</p>
      <div class="detail-options">
        <div class="option-title">Select Color</div>
        <div class="color-options">
          <div class="color-dot active" style="background:#d4af37" title="Gold"></div>
          <div class="color-dot" style="background:#c0c0c0" title="Silver"></div>
          <div class="color-dot" style="background:#1a1a1a" title="Black"></div>
          <div class="color-dot" style="background:#8B4513" title="Brown"></div>
        </div>
      </div>
      <div class="detail-options mt-2">
        <div class="option-title">Select Size</div>
        <div class="size-options">
          <button class="size-btn">XS</button>
          <button class="size-btn active">S</button>
          <button class="size-btn">M</button>
          <button class="size-btn">L</button>
          <button class="size-btn">XL</button>
        </div>
      </div>
      <div class="qty-row mt-3">
        <span class="qty-label">Quantity</span>
        <div class="qty-control">
          <button class="qty-btn" onclick="changeDetailQty(-1)">−</button>
          <input class="qty-val" id="detail-qty" value="1" readonly/>
          <button class="qty-btn" onclick="changeDetailQty(1)">+</button>
        </div>
      </div>
      <div class="detail-btns">
        <button class="btn btn-gold" onclick="addDetailToCart()">
          <span>🛒</span> Add to Cart
        </button>
        <button class="btn btn-outline" onclick="addToWishlistFromDetail()">
          <span>♡</span> Wishlist
        </button>
        <button class="btn btn-white" onclick="addDetailToCart();showPage('checkout')">
          Buy Now →
        </button>
      </div>
      <div class="detail-features">
        <div class="detail-feature">
          <span class="detail-feature-icon">🚚</span>
          <span class="detail-feature-text">Free shipping on orders over $100</span>
        </div>
        <div class="detail-feature">
          <span class="detail-feature-icon">↩️</span>
          <span class="detail-feature-text">30-day easy returns</span>
        </div>
        <div class="detail-feature">
          <span class="detail-feature-icon">🔒</span>
          <span class="detail-feature-text">2-year warranty included</span>
        </div>
      </div>
    </div>
  </div>
  <div class="reviews-section">
    <div class="reviews-header">
      <h2>Customer Reviews</h2>
      <button class="btn btn-outline btn-sm">Write a Review</button>
    </div>
    <div class="reviews-grid" id="reviews-list"></div>
  </div>
</div>

<!-- ════════════════════════════════════════
     CART PAGE
════════════════════════════════════════ -->
<div class="page" id="page-cart">
  <div class="page-hero">
    <div class="breadcrumb">
      <a onclick="showPage('home')">Home</a>
      <span class="separator">›</span>
      <span>Shopping Cart</span>
    </div>
    <h1>Your Cart</h1>
  </div>
  <div class="cart-layout" id="cart-content"></div>
</div>

<!-- ════════════════════════════════════════
     CHECKOUT PAGE
════════════════════════════════════════ -->
<div class="page" id="page-checkout">
  <div class="page-hero">
    <div class="breadcrumb">
      <a onclick="showPage('home')">Home</a>
      <span class="separator">›</span>
      <a onclick="showPage('cart')">Cart</a>
      <span class="separator">›</span>
      <span>Checkout</span>
    </div>
    <h1>Checkout</h1>
  </div>
  <div class="checkout-steps">
    <div class="checkout-step completed">
      <span class="step-number">✓</span>
      <span class="step-text">
      Cart</span>
    </div>
    <div class="step-line"></div>
    <div class="checkout-step active">
      <span class="step-number">2</span>
      <span class="step-text">Shipping</span>
    </div>
    <div class="step-line"></div>
    <div class="checkout-step">
      <span class="step-number">3</span>
      <span class="step-text">Payment</span>
    </div>
    <div class="step-line"></div>
    <div class="checkout-step">
      <span class="step-number">4</span>
      <span class="step-text">Confirm</span>
    </div>
  </div>
  <div class="checkout-layout">
    <div>
      <!-- Shipping Info -->
      <div class="checkout-form-box">
        <div class="form-section-title">Shipping Information</div>
        <div class="form-grid">
          <div class="form-group" id="fg-fname">
            <label>First Name *</label>
            <input type="text" id="fname" placeholder="John"/>
            <span class="error-msg">Please enter your first name</span>
          </div>
          <div class="form-group" id="fg-lname">
            <label>Last Name *</label>
            <input type="text" id="lname" placeholder="Doe"/>
            <span class="error-msg">Please enter your last name</span>
          </div>
          <div class="form-group" id="fg-email">
            <label>Email Address *</label>
            <input type="email" id="co-email" placeholder="john@email.com"/>
            <span class="error-msg">Please enter a valid email</span>
          </div>
          <div class="form-group" id="fg-phone">
            <label>Phone Number *</label>
            <input type="tel" id="phone" placeholder="+1 234 567 8900"/>
            <span class="error-msg">Please enter your phone number</span>
          </div>
          <div class="form-group full" id="fg-address">
            <label>Street Address *</label>
            <input type="text" id="address" placeholder="123 Main Street, Apt 4B"/>
            <span class="error-msg">Please enter your address</span>
          </div>
          <div class="form-group" id="fg-city">
            <label>City *</label>
            <input type="text" id="city" placeholder="New York"/>
            <span class="error-msg">Please enter your city</span>
          </div>
          <div class="form-group" id="fg-zip">
            <label>ZIP / Postal Code *</label>
            <input type="text" id="zip" placeholder="10001"/>
            <span class="error-msg">Please enter ZIP code</span>
          </div>
          <div class="form-group full">
            <label>Country</label>
            <select id="country">
              <option>United States</option>
              <option>United Kingdom</option>
              <option>Canada</option>
              <option>Australia</option>
              <option>Germany</option>
              <option>France</option>
              <option>Japan</option>
              <option>Singapore</option>
            </select>
          </div>
          <div class="form-group full">
            <label>Order Notes (Optional)</label>
            <textarea id="notes" placeholder="Special delivery instructions, gift message, etc..."></textarea>
          </div>
        </div>
      </div>

      <!-- Payment Method -->
      <div class="checkout-form-box">
        <div class="form-section-title">Payment Method</div>
        <div class="payment-options">
          <div class="payment-option selected" onclick="selectPayment(this)">
            <input type="radio" name="payment" checked/>
            <span class="payment-icon">💳</span>
            <div class="payment-info">
              <div class="payment-label">Credit / Debit Card</div>
              <div class="payment-desc">Visa, Mastercard, American Express</div>
            </div>
          </div>
          <div class="payment-option" onclick="selectPayment(this)">
            <input type="radio" name="payment"/>
            <span class="payment-icon">🅿️</span>
            <div class="payment-info">
              <div class="payment-label">PayPal</div>
              <div class="payment-desc">Pay securely with your PayPal account</div>
            </div>
          </div>
          <div class="payment-option" onclick="selectPayment(this)">
            <input type="radio" name="payment"/>
            <span class="payment-icon">🍎</span>
            <div class="payment-info">
              <div class="payment-label">Apple Pay</div>
              <div class="payment-desc">Fast & secure checkout</div>
            </div>
          </div>
          <div class="payment-option" onclick="selectPayment(this)">
            <input type="radio" name="payment"/>
            <span class="payment-icon">🏦</span>
            <div class="payment-info">
              <div class="payment-label">Bank Transfer</div>
              <div class="payment-desc">Direct bank payment</div>
            </div>
          </div>
        </div>
      </div>

      <button class="btn btn-gold w-full btn-lg" onclick="placeOrder()">
        <span>🔒</span> Place Order Securely
      </button>
      <p class="text-center text-gray mt-2" style="font-size:0.82rem">
        By placing this order, you agree to our Terms of Service and Privacy Policy
      </p>
    </div>

    <!-- Order Summary Sidebar -->
    <div class="order-summary-side">
      <div class="cart-summary">
        <div class="summary-title">Order Summary</div>
        <div class="order-items" id="checkout-order-items"></div>
        <div id="checkout-summary-totals"></div>
        <div class="promo-box">
          <div class="promo-input">
            <input type="text" placeholder="Promo code" id="checkout-promo"/>
            <button class="btn btn-dark btn-sm" onclick="applyPromo()">Apply</button>
          </div>
        </div>
        <div class="secure-badges">
          <div class="secure-badge">🔒 SSL Secured</div>
          <div class="secure-badge">✓ PCI Compliant</div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- ════════════════════════════════════════
     LOGIN PAGE
════════════════════════════════════════ -->
<div class="page" id="page-login">
  <div class="auth-page">
    <div class="auth-card">
      <div class="auth-header">
        <div class="auth-logo">LUXE</div>
        <p class="auth-subtitle">Welcome back — sign in to continue</p>
      </div>
      <form class="auth-form" onsubmit="handleLogin(event)">
        <div class="auth-input-group">
          <span class="icon">📧</span>
          <input type="email" id="login-email" placeholder="Email address" required/>
        </div>
        <div class="auth-input-group">
          <span class="icon">🔒</span>
          <input type="password" id="login-pass" placeholder="Password" required/>
        </div>
        <div class="auth-options">
          <label class="auth-remember">
            <input type="checkbox"/> Remember me
          </label>
          <a href="#" class="auth-forgot">Forgot password?</a>
        </div>
        <button type="submit" class="btn btn-gold w-full btn-lg">Sign In</button>
        <div class="auth-divider">or continue with</div>
        <div class="auth-social">
          <button type="button" class="auth-social-btn">
            <span>G</span> Google
          </button>
          <button type="button" class="auth-social-btn">
            <span>🍎</span> Apple
          </button>
        </div>
      </form>
      <div class="auth-footer">
        Don't have an account? <a onclick="showPage('register')">Create one</a>
      </div>
    </div>
  </div>
</div>

<!-- ════════════════════════════════════════
     REGISTER PAGE
════════════════════════════════════════ -->
<div class="page" id="page-register">
  <div class="auth-page">
    <div class="auth-card">
      <div class="auth-header">
        <div class="auth-logo">LUXE</div>
        <p class="auth-subtitle">Create your account to get started</p>
      </div>
      <form class="auth-form" action="backend/add_user.php" method="POST">
        <div class="auth-input-group">
          <span class="icon">👤</span>
          <input type="text" id="reg-name" name="fullname" placeholder="Full name" required/>
        </div>
        <div class="auth-input-group">
          <span class="icon">📧</span>
          <input type="email" id="reg-email" name="email" placeholder="Email address" required/>
        </div>
        <div class="auth-input-group">
          <span class="icon">🔒</span>
          <input type="password" id="reg-pass" name="password" placeholder="Password (min 6 characters)" required/>
        </div>
        <div class="auth-input-group">
          <span class="icon">🔒</span>
          <input type="password" id="reg-confirm" placeholder="Confirm password" required/>
        </div>
        <label class="auth-remember">
          <input type="checkbox" required/> I agree to the Terms of Service and Privacy Policy
        </label>
        <button type="submit" class="btn btn-gold w-full btn-lg">Create Account</button>
        <div class="auth-divider">or continue with</div>
        <div class="auth-social">
          <button type="button" class="auth-social-btn">
            <span>G</span> Google
          </button>
          <button type="button" class="auth-social-btn">
            <span>🍎</span> Apple
          </button>
        </div>
      </form>
      <div class="auth-footer">
        Already have an account? <a onclick="showPage('login')">Sign in</a>
      </div>
    </div>
  </div>
</div>

<!-- ════════════════════════════════════════
     ADMIN PANEL
════════════════════════════════════════ -->
<div class="page" id="page-admin">
  <div class="admin-layout">
    <!-- Sidebar -->
    <aside class="admin-sidebar">
      <div class="admin-logo">LUXE Admin</div>
      <nav class="admin-nav">
        <div class="admin-nav-item active" onclick="showAdminTab('dashboard',this)">
          <span class="admin-nav-icon">📊</span> Dashboard
        </div>
        <div class="admin-nav-item" onclick="showAdminTab('products',this)">
          <span class="admin-nav-icon">📦</span> Products
        </div>
        <div class="admin-nav-item" onclick="showAdminTab('orders',this)">
          <span class="admin-nav-icon">🛒</span> Orders
        </div>
        <div class="admin-nav-item" onclick="showAdminTab('users',this)">
          <span class="admin-nav-icon">👥</span> Customers
        </div>
        <div class="admin-nav-item" onclick="showAdminTab('analytics',this)">
          <span class="admin-nav-icon">📈</span> Analytics
        </div>
        <div class="admin-nav-item" onclick="showAdminTab('settings',this)">
          <span class="admin-nav-icon">⚙️</span> Settings
        </div>
        <div class="admin-nav-item" onclick="showPage('home')" style="margin-top:2rem;border-top:1px solid var(--border);padding-top:1.5rem">
          <span class="admin-nav-icon">🏠</span> Back to Store
        </div>
      </nav>
    </aside>

    <!-- Main Content -->
    <main class="admin-content">
      <!-- Dashboard Tab -->
      <div id="admin-dashboard">
        <div class="admin-header">
          <h1>Dashboard</h1>
          <div class="admin-header-right">
            <div class="admin-search">
              <span>🔍</span>
              <input type="text" placeholder="Search..."/>
            </div>
            <div class="admin-user">
              <div class="admin-avatar">A</div>
              <span>Admin</span>
            </div>
          </div>
        </div>
        <div class="admin-stats">
          <div class="admin-stat">
            <div class="admin-stat-icon">💰</div>
            <div class="admin-stat-value">$84,254</div>
            <div class="admin-stat-label">Total Revenue</div>
            <div class="admin-stat-change">↑ 12.5% vs last month</div>
          </div>
          <div class="admin-stat">
            <div class="admin-stat-icon">🛒</div>
            <div class="admin-stat-value">1,284</div>
            <div class="admin-stat-label">Total Orders</div>
            <div class="admin-stat-change">↑ 8.2% vs last month</div>
          </div>
          <div class="admin-stat">
            <div class="admin-stat-icon">👥</div>
            <div class="admin-stat-value">3,842</div>
            <div class="admin-stat-label">Total Customers</div>
            <div class="admin-stat-change">↑ 24.1% vs last month</div>
          </div>
          <div class="admin-stat">
            <div class="admin-stat-icon">📦</div>
            <div class="admin-stat-value" id="admin-total-products">12</div>
            <div class="admin-stat-label">Total Products</div>
            <div class="admin-stat-change">↑ 4 new this week</div>
          </div>
        </div>
        <div class="admin-section">
          <div class="admin-section-head">
            <h3>📋 Recent Orders</h3>
            <button class="btn btn-outline btn-sm" onclick="showAdminTab('orders',null)">View All</button>
          </div>
          <table class="data-table">
            <thead>
              <tr>
                <th>Order ID</th>
                <th>Customer</th>
                <th>Items</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Date</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><strong>#ORD-2851</strong></td>
                <td>Alexandra Mitchell</td>
                <td>3 items</td>
                <td class="text-gold">$1,299.00</td>
                <td><span class="status-badge status-delivered">Delivered</span></td>
                <td>Mar 05, 2025</td>
                <td><div class="table-actions"><button class="action-btn action-view">View</button></div></td>
              </tr>
              <tr>
                <td><strong>#ORD-2850</strong></td>
                <td>James Thompson</td>
                <td>1 item</td>
                <td class="text-gold">$799.00</td>
                <td><span class="status-badge status-shipped">Shipped</span></td>
                <td>Mar 04, 2025</td>
                <td><div class="table-actions"><button class="action-btn action-view">View</button></div></td>
              </tr>
              <tr>
                <td><strong>#ORD-2849</strong></td>
                <td>Sofia Rodriguez</td>
                <td>2 items</td>
                <td class="text-gold">$549.00</td>
                <td><span class="status-badge status-processing">Processing</span></td>
                <td>Mar 04, 2025</td>
                <td><div class="table-actions"><button class="action-btn action-view">View</button></div></td>
              </tr>
              <tr>
                <td><strong>#ORD-2848</strong></td>
                <td>Michael Chen</td>
                <td>5 items</td>
                <td class="text-gold">$2,499.00</td>
                <td><span class="status-badge status-pending">Pending</span></td>
                <td>Mar 03, 2025</td>
                <td><div class="table-actions"><button class="action-btn action-view">View</button></div></td>
              </tr>
              <tr>
                <td><strong>#ORD-2847</strong></td>
                <td>Emily Watson</td>
                <td>1 item</td>
                <td class="text-gold">$349.00</td>
                <td><span class="status-badge status-cancelled">Cancelled</span></td>
                <td>Mar 02, 2025</td>
                <td><div class="table-actions"><button class="action-btn action-view">View</button></div></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <!-- Products Tab -->
      <div id="admin-products" style="display:none">
        <div class="admin-header">
          <h1>Product Management</h1>
          <button class="btn btn-gold" onclick="openAddProductModal()">+ Add New Product</button>
        </div>
        <div class="admin-section">
          <div class="admin-section-head">
            <h3>📦 All Products</h3>
            <span class="text-gray" style="font-size:0.85rem" id="admin-product-count"></span>
          </div>
          <table class="data-table" id="admin-products-table">
            <thead>
              <tr>
                <th>Image</th>
                <th>Product Name</th>
                <th>Category</th>
                <th>Price</th>
                <th>Rating</th>
                <th>Stock</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody id="admin-products-body"></tbody>
          </table>
        </div>
      </div>

      <!-- Orders Tab -->
      <div id="admin-orders" style="display:none">
        <div class="admin-header">
          <h1>Order Management</h1>
          <div class="admin-header-right">
            <select class="sort-select">
              <option>All Orders</option>
              <option>Pending</option>
              <option>Processing</option>
              <option>Shipped</option>
              <option>Delivered</option>
              <option>Cancelled</option>
            </select>
          </div>
        </div>
        <div class="admin-section">
          <div class="admin-section-head">
            <h3>🛒 All Orders</h3>
            <span class="text-gray">48 total orders</span>
          </div>
          <table class="data-table">
            <thead>
              <tr>
                <th>Order ID</th>
                <th>Customer</th>
                <th>Email</th>
                <th>Items</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Date</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><strong>#ORD-2851</strong></td>
                <td>Alexandra Mitchell</td>
                <td class="text-gray">alex@email.com</td>
                <td>3 items</td>
                <td class="text-gold">$1,299.00</td>
                <td><span class="status-badge status-delivered">Delivered</span></td>
                <td>Mar 05, 2025</td>
                <td>
                  <div class="table-actions">
                    <button class="action-btn action-view">View</button>
                    <button class="action-btn action-edit">Edit</button>
                  </div>
                </td>
              </tr>
              <tr>
                <td><strong>#ORD-2850</strong></td>
                <td>James Thompson</td>
                <td class="text-gray">james@email.com</td>
                <td>1 item</td>
                <td class="text-gold">$799.00</td>
                <td><span class="status-badge status-shipped">Shipped</span></td>
                <td>Mar 04, 2025</td>
                <td>
                  <div class="table-actions">
                    <button class="action-btn action-view">View</button>
                    <button class="action-btn action-edit">Edit</button>
                  </div>
                </td>
              </tr>
              <tr>
                <td><strong>#ORD-2849</strong></td>
                <td>Sofia Rodriguez</td>
                <td class="text-gray">sofia@email.com</td>
                <td>2 items</td>
                <td class="text-gold">$549.00</td>
                <td><span class="status-badge status-processing">Processing</span></td>
                <td>Mar 04, 2025</td>
                <td>
                  <div class="table-actions">
                    <button class="action-btn action-view">View</button>
                    <button class="action-btn action-edit">Edit</button>
                  </div>
                </td>
              </tr>
              <tr>
                <td><strong>#ORD-2848</strong></td>
                <td>Michael Chen</td>
                <td class="text-gray">michael@email.com</td>
                <td>5 items</td>
                <td class="text-gold">$2,499.00</td>
                <td><span class="status-badge status-pending">Pending</span></td>
                <td>Mar 03, 2025</td>
                <td>
                  <div class="table-actions">
                    <button class="action-btn action-view">View</button>
                    <button class="action-btn action-edit">Edit</button>
                  </div>
                </td>
              </tr>
              <tr>
                <td><strong>#ORD-2847</strong></td>
                <td>Emily Watson</td>
                <td class="text-gray">emily@email.com</td>
                <td>1 item</td>
                <td class="text-gold">$349.00</td>
                <td><span class="status-badge status-cancelled">Cancelled</span></td>
                <td>Mar 02, 2025</td>
                <td>
                  <div class="table-actions">
                    <button class="action-btn action-view">View</button>
                    <button class="action-btn action-del">Delete</button>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <!-- Users Tab -->
      <div id="admin-users" style="display:none">
        <div class="admin-header">
          <h1>Customer Management</h1>
          <button class="btn btn-outline">Export CSV</button>
        </div>
        <div class="admin-section">
          <div class="admin-section-head">
            <h3>👥 Registered Customers</h3>
            <span class="text-gray">3,842 total customers</span>
          </div>
          <table class="data-table">
            <thead>
              <tr>
                <th>Customer</th>
                <th>Email</th>
                <th>Orders</th>
                <th>Total Spent</th>
                <th>Joined</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><div class="flex items-center gap-2"><div class="admin-avatar" style="width:32px;height:32px;font-size:0.75rem">AM</div>Alexandra Mitchell</div></td>
                <td class="text-gray">alex@email.com</td>
                <td>24</td>
                <td class="text-gold">$8,450</td>
                <td>Jan 2024</td>
                <td><span class="status-badge status-delivered">VIP</span></td>
                <td>
                  <div class="table-actions">
                    <button class="action-btn action-view">View</button>
                    <button class="action-btn action-edit">Edit</button>
                  </div>
                </td>
              </tr>
              <tr>
                <td><div class="flex items-center gap-2"><div class="admin-avatar" style="width:32px;height:32px;font-size:0.75rem">JT</div>James Thompson</div></td>
                <td class="text-gray">james@email.com</td>
                <td>12</td>
                <td class="text-gold">$3,299</td>
                <td>Feb 2024</td>
                <td><span class="status-badge status-shipped">Active</span></td>
                <td>
                  <div class="table-actions">
                    <button class="action-btn action-view">View</button>
                    <button class="action-btn action-edit">Edit</button>
                  </div>
                </td>
              </tr>
              <tr>
                <td><div class="flex items-center gap-2"><div class="admin-avatar" style="width:32px;height:32px;font-size:0.75rem">SR</div>Sofia Rodriguez</div></td>
                <td class="text-gray">sofia@email.com</td>
                <td>8</td>
                <td class="text-gold">$2,150</td>
                <td>Mar 2024</td>
                <td><span class="status-badge status-shipped">Active</span></td>
                <td>
                  <div class="table-actions">
                    <button class="action-btn action-view">View</button>
                    <button class="action-btn action-edit">Edit</button>
                  </div>
                </td>
              </tr>
              <tr>
                <td><div class="flex items-center gap-2"><div class="admin-avatar" style="width:32px;height:32px;font-size:0.75rem">MC</div>Michael Chen</div></td>
                <td class="text-gray">michael@email.com</td>
                <td>3</td>
                <td class="text-gold">$899</td>
                <td>Mar 2025</td>
                <td><span class="status-badge status-processing">New</span></td>
                <td>
                  <div class="table-actions">
                    <button class="action-btn action-view">View</button>
                    <button class="action-btn action-edit">Edit</button>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <!-- Analytics Tab -->
      <div id="admin-analytics" style="display:none">
        <div class="admin-header">
          <h1>Analytics & Reports</h1>
          <select class="sort-select">
            <option>Last 7 Days</option>
            <option>Last 30 Days</option>
            <option>Last 90 Days</option>
            <option>This Year</option>
          </select>
        </div>
        <div class="admin-stats">
          <div class="admin-stat">
            <div class="admin-stat-icon">👁️</div>
            <div class="admin-stat-value">124K</div>
            <div class="admin-stat-label">Page Views</div>
            <div class="admin-stat-change">↑ 18.3% vs last period</div>
          </div>
          <div class="admin-stat">
            <div class="admin-stat-icon">🛒</div>
            <div class="admin-stat-value">3.2%</div>
            <div class="admin-stat-label">Conversion Rate</div>
            <div class="admin-stat-change">↑ 0.8% vs last period</div>
          </div>
          <div class="admin-stat">
            <div class="admin-stat-icon">💵</div>
            <div class="admin-stat-value">$186</div>
            <div class="admin-stat-label">Avg Order Value</div>
            <div class="admin-stat-change">↑ $12 vs last period</div>
          </div>
          <div class="admin-stat">
            <div class="admin-stat-icon">↩️</div>
            <div class="admin-stat-value">2.1%</div>
            <div class="admin-stat-label">Return Rate</div>
            <div class="admin-stat-change negative">↓ 0.3% vs last period</div>
          </div>
        </div>
        <div class="admin-section">
          <div class="admin-section-head">
            <h3>📈 Sales Overview</h3>
          </div>
          <div style="padding:3rem;text-align:center;color:var(--gray)">
            <div style="font-size:4rem;margin-bottom:1rem">📊</div>
            <p>Analytics charts would be displayed here</p>
            <p style="font-size:0.85rem">Integration with Chart.js or similar library</p>
          </div>
        </div>
      </div>

      <!-- Settings Tab -->
      <div id="admin-settings" style="display:none">
        <div class="admin-header">
          <h1>Settings</h1>
        </div>
        <div class="admin-section">
          <div class="admin-section-head">
            <h3>⚙️ General Settings</h3>
          </div>
          <div style="padding:2rem">
            <div class="form-grid" style="max-width:600px">
              <div class="form-group full">
                <label>Store Name</label>
                <input type="text" value="LUXE Premium Store"/>
              </div>
              <div class="form-group full">
                <label>Store Email</label>
                <input type="email" value="support@luxe.com"/>
              </div>
              <div class="form-group full">
                <label>Currency</label>
                <select>
                  <option>USD ($)</option>
                  <option>EUR (€)</option>
                  <option>GBP (£)</option>
                </select>
              </div>
              <div class="form-group full">
                <label>Timezone</label>
                <select>
                  <option>America/New_York (EST)</option>
                  <option>America/Los_Angeles (PST)</option>
                  <option>Europe/London (GMT)</option>
                </select>
              </div>
              <div class="form-group full" style="margin-top:1rem">
                <button class="btn btn-gold">Save Changes</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
  </div>
</div>

<!-- ════════════════════════════════════════
     MODALS
════════════════════════════════════════ -->

<!-- Add Product Modal -->
<div class="modal-overlay" id="add-product-modal">
  <div class="modal">
    <div class="modal-head">
      <h3>Add New Product</h3>
      <button class="modal-close" onclick="closeModal('add-product-modal')">✕</button>
    </div>
    <form onsubmit="handleAddProduct(event)">
      <div class="form-grid">
        <div class="form-group full">
          <label>Product Name *</label>
          <input type="text" id="ap-name" placeholder="e.g. Premium Leather Watch"/>
        </div>
        <div class="form-group">
          <label>Price *</label>
          <input type="number" id="ap-price" placeholder="299.00" step="0.01"/>
        </div>
        <div class="form-group">
          <label>Category *</label>
          <select id="ap-category">
            <option>Electronics</option>
            <option>Fashion</option>
            <option>Watches</option>
            <option>Jewelry</option>
            <option>Home</option>
            <option>Beauty</option>
          </select>
        </div>
        <div class="form-group full">
          <label>Description</label>
          <textarea id="ap-desc" placeholder="Describe your product..." rows="3"></textarea>
        </div>
        <div class="form-group">
          <label>Icon / Emoji</label>
          <input type="text" id="ap-icon" placeholder="⌚" maxlength="4"/>
        </div>
        <div class="form-group">
          <label>Old Price (optional)</label>
          <input type="number" id="ap-old-price" placeholder="399.00" step="0.01"/>
        </div>
      </div>
      <div style="margin-top:2rem;display:flex;gap:1rem;justify-content:flex-end">
        <button type="button" class="btn btn-outline" onclick="closeModal('add-product-modal')">Cancel</button>
        <button type="submit" class="btn btn-gold">Add Product</button>
      </div>
    </form>
  </div>
</div>

<!-- Order Success Modal -->
<div class="modal-overlay" id="order-success-modal">
  <div class="modal success-modal">
    <div class="success-icon">✓</div>
    <h3>Order Placed Successfully!</h3>
    <p>Thank you for your purchase. Your order has been confirmed and will be shipped within 1-2 business days.</p>
    <div class="order-id-box">
      <div class="order-id-label">Order ID</div>
      <div class="order-id-value" id="order-id-display">#ORD-XXXX</div>
    </div>
    <p style="font-size:0.88rem;color:var(--gray);margin-bottom:2rem">
      A confirmation email has been sent to your email address.
    </p>
    <button class="btn btn-gold w-full" onclick="closeModal('order-success-modal');showPage('home')">
      Continue Shopping
    </button>
  </div>
</div>

<!-- Toast Container -->
<div class="toast-container" id="toast-container"></div>

<!-- ════════════════════════════════════════
     JAVASCRIPT
════════════════════════════════════════ -->
<script>
/* ────────────────────────────────────────
   PRODUCT DATA
──────────────────────────────────────── */
const products = [
  {id:1, name:'Luminara Gold Watch', cat:'Watches', price:1299, oldPrice:1799, rating:4.9, reviews:284, icon:'⌚', badge:'Best Seller', desc:'Exquisite handcrafted timepiece featuring 18k gold-plated case, Swiss movement, and sapphire crystal glass. Water resistant to 50m. Comes with a 2-year international warranty.'},
  {id:2, name:'AirPods Pro Max', cat:'Electronics', price:549, oldPrice:649, rating:4.8, reviews:1203, icon:'🎧', badge:'Hot', desc:'Industry-leading noise cancellation with Adaptive Audio. Personalized Spatial Audio with dynamic head tracking. Stunning computational audio for an immersive experience.'},
  {id:3, name:'Diamond Solitaire Ring', cat:'Jewelry', price:2499, oldPrice:null, rating:5.0, reviews:89, icon:'💍', badge:'Premium', desc:'Elegant solitaire ring featuring a 1-carat GIA certified diamond set in a platinum six-prong setting. Perfect for engagements and special occasions.'},
  {id:4, name:'Silk Evening Dress', cat:'Fashion', price:349, oldPrice:499, rating:4.7, reviews:156, icon:'👗', badge:'Sale', desc:'Luxurious 100% pure silk evening gown with hand-sewn embellishments. Features a flattering A-line silhouette and hidden zipper closure.'},
  {id:5, name:'Smart Home Hub Pro', cat:'Electronics', price:299, oldPrice:399, rating:4.6, reviews:412, icon:'🏠', badge:null, desc:'Control all your smart devices from one elegant hub. Compatible with Alexa, Google Home, HomeKit, and over 1000 smart home devices.'},
  {id:6, name:'Rose Gold Necklace', cat:'Jewelry', price:799, oldPrice:null, rating:4.8, reviews:203, icon:'📿', badge:'New', desc:'18k rose gold chain featuring a hand-set diamond pendant with 0.5 carats total weight. Adjustable length from 16" to 18". Comes in luxury gift box.'},
  {id:7, name:'Italian Leather Tote', cat:'Fashion', price:459, oldPrice:599, rating:4.5, reviews:318, icon:'👜', badge:'Sale', desc:'Full-grain Italian leather tote with brass hardware and cotton twill lining. Features laptop compartment (fits 15"), multiple pockets, and magnetic closure.'},
  {id:8, name:'Espresso Machine Deluxe', cat:'Home', price:699, oldPrice:899, rating:4.7, reviews:521, icon:'☕', badge:null, desc:'Professional-grade espresso machine with 15-bar Italian pump, built-in conical burr grinder, and automatic milk frother. Makes barista-quality coffee at home.'},
  {id:9, name:'Vitamin C Serum Pro', cat:'Beauty', price:89, oldPrice:119, rating:4.8, reviews:944, icon:'✨', badge:'Bestseller', desc:'Advanced 20% Vitamin C formula with hyaluronic acid, vitamin E, and ferulic acid. Brightens skin, reduces fine lines, and provides antioxidant protection.'},
  {id:10, name:'Carbon Fiber Sunglasses', cat:'Fashion', price:289, oldPrice:null, rating:4.6, reviews:167, icon:'🕶️', badge:'New', desc:'Ultra-lightweight carbon fiber frames with polarized UV400 lenses and titanium hinges. Weighs only 18g. Includes premium case and cleaning cloth.'},
  {id:11, name:'Smart Fitness Ring', cat:'Electronics', price:349, oldPrice:449, rating:4.4, reviews:289, icon:'💪', badge:null, desc:'24/7 health monitoring in a sleek titanium ring. Tracks sleep quality, heart rate, HRV, SpO2, activity, and more. 7-day battery life with wireless charging.'},
  {id:12, name:'Scottish Cashmere Scarf', cat:'Fashion', price:199, oldPrice:279, rating:4.9, reviews:412, icon:'🧣', badge:'Sale', desc:'100% pure Scottish cashmere scarf, ethically sourced and hand-finished. Classic plaid pattern in rich colors. Exceptionally soft and warm.'},
];

const reviews = [
  {name:'Alexandra M.', initials:'AM', rating:5, text:'Absolutely stunning quality. The packaging alone was impressive, and the product exceeded all my expectations. The attention to detail is remarkable. Will definitely purchase again!', date:'Feb 28, 2025', verified:true},
  {name:'James T.', initials:'JT', rating:5, text:'Fast shipping and excellent customer service. The watch I ordered was exactly as pictured, and the craftsmanship is exceptional for the price point. Highly recommended.', date:'Feb 20, 2025', verified:true},
  {name:'Sofia R.', initials:'SR', rating:4, text:'I bought this as a gift and the recipient was overjoyed. Beautiful quality, arrived in perfect condition with premium packaging. Only minor issue was slightly longer shipping time than expected.', date:'Feb 15, 2025', verified:true},
];

/* ────────────────────────────────────────
   STATE MANAGEMENT
──────────────────────────────────────── */
let cart = [];
let wishlist = [];
let currentDetailProduct = null;
let selectedCategoryFilter = null;

/* ────────────────────────────────────────
   LOADING SCREEN
──────────────────────────────────────── */
window.addEventListener('load', function() {
  setTimeout(() => {
    document.getElementById('loading-screen').classList.add('hidden');
  }, 1500);
});

/* ────────────────────────────────────────
   CUSTOM CURSOR
──────────────────────────────────────── */
const cursor = document.getElementById('cursor');
const cursorDot = document.getElementById('cursor-dot');

if (window.innerWidth > 768) {
  document.addEventListener('mousemove', (e) => {
    cursor.style.left = e.clientX + 'px';
    cursor.style.top = e.clientY + 'px';
    cursorDot.style.left = e.clientX + 'px';
    cursorDot.style.top = e.clientY + 'px';
  });

  document.querySelectorAll('a, button, .product-card, .category-card, input, select, textarea').forEach(el => {
    el.addEventListener('mouseenter', () => {
      cursor.classList.add('hover');
      cursorDot.classList.add('hover');
    });
    el.addEventListener('mouseleave', () => {
      cursor.classList.remove('hover');
      cursorDot.classList.remove('hover');
    });
  });
}

/* ────────────────────────────────────────
   NAVBAR SCROLL EFFECT
──────────────────────────────────────── */
window.addEventListener('scroll', () => {
  const navbar = document.getElementById('navbar');
  const backToTop = document.getElementById('back-to-top');
  
  if (window.scrollY > 50) {
    navbar.classList.add('scrolled');
  } else {
    navbar.classList.remove('scrolled');
  }
  
  if (window.scrollY > 500) {
    backToTop.classList.add('visible');
  } else {
    backToTop.classList.remove('visible');
  }
});

/* ────────────────────────────────────────
   INTERSECTION OBSERVER FOR ANIMATIONS
──────────────────────────────────────── */
const observerOptions = {
  threshold: 0.1,
  rootMargin: '0px 0px -50px 0px'
};

const observer = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      entry.target.classList.add('animated');
    }
  });
}, observerOptions);

document.querySelectorAll('[data-animate]').forEach(el => observer.observe(el));

/* ────────────────────────────────────────
   COUNTDOWN TIMER
──────────────────────────────────────── */
function updateCountdown() {
  const endDate = new Date();
  endDate.setDate(endDate.getDate() + 2);
  endDate.setHours(23, 59, 59);
  
  const now = new Date();
  const diff = endDate - now;
  
  const days = Math.floor(diff / (1000 * 60 * 60 * 24));
  const hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
  const seconds = Math.floor((diff % (1000 * 60)) / 1000);
  
  document.getElementById('days').textContent = String(days).padStart(2, '0');
  document.getElementById('hours').textContent = String(hours).padStart(2, '0');
  document.getElementById('minutes').textContent = String(minutes).padStart(2, '0');
  document.getElementById('seconds').textContent = String(seconds).padStart(2, '0');
}

setInterval(updateCountdown, 1000);
updateCountdown();

/* ────────────────────────────────────────
   PAGE NAVIGATION
──────────────────────────────────────── */
window.showPage = function(id) {
  document.querySelectorAll('.page').forEach(p => p.classList.remove('active'));
  const page = document.getElementById('page-' + id);
  if (page) {
    page.classList.add('active');
    window.scrollTo({top: 0, behavior: 'smooth'});
    
    // Re-observe animations
    page.querySelectorAll('[data-animate]').forEach(el => {
      el.classList.remove('animated');
      observer.observe(el);
    });
  }
  
  // Close mobile menu
  document.getElementById('mobile-menu').classList.remove('open');
  document.getElementById('hamburger-btn').classList.remove('active');
  
  // Render page-specific content
  if (id === 'home') renderFeaturedProducts();
  if (id === 'shop') renderShopProducts();
  if (id === 'cart') renderCart();
  if (id === 'checkout') renderCheckoutSummary();
  if (id === 'admin') renderAdminProducts();
  if (id === 'detail') renderDetailPage();
}

/* ────────────────────────────────────────
   WISHLIST
──────────────────────────────────────── */
window.toggleWishlist = function() {
  document.getElementById('wishlist-sidebar').classList.toggle('open');
  document.getElementById('wishlist-overlay').classList.toggle('open');
  renderWishlist();
}

window.addToWishlist = function(id) {
  const product = products.find(p => p.id === id);
  if (!wishlist.find(i => i.id === id)) {
    wishlist.push(product);
    showToast('Added to Wishlist', product.name + ' saved to your wishlist', 'success');
    renderWishlist();
  } else {
    showToast('Already in Wishlist', 'This item is already saved', 'info');
  }
}

window.addToWishlistFromDetail = function() {
  if (currentDetailProduct) {
    addToWishlist(currentDetailProduct.id);
  }
}

window.removeFromWishlist = function(id) {
  wishlist = wishlist.filter(i => i.id !== id);
  renderWishlist();
}

window.renderWishlist = function() {
  const container = document.getElementById('wishlist-items');
  if (wishlist.length === 0) {
    container.innerHTML = `
      <div class="empty-cart" style="padding:2rem">
        <div class="icon">💔</div>
        <h3>Your wishlist is empty</h3>
        <p>Save items you love for later</p>
      </div>`;
    return;
  }
  
  container.innerHTML = wishlist.map(item => `
    <div class="wishlist-item">
      <div class="wishlist-item-img">${item.icon}</div>
      <div class="wishlist-item-info">
        <div class="wishlist-item-name">${item.name}</div>
        <div class="wishlist-item-price">$${item.price.toLocaleString()}</div>
      </div>
      <div class="wishlist-item-actions">
        <button class="btn btn-gold btn-sm" onclick="addToCart(${item.id});removeFromWishlist(${item.id})">Add</button>
        <button class="btn btn-outline btn-sm" onclick="removeFromWishlist(${item.id})">✕</button>
      </div>
    </div>
  `).join('');
}

/* ────────────────────────────────────────
   RENDER FEATURED PRODUCTS (HOME)
──────────────────────────────────────── */
window.renderFeaturedProducts = function() {
  const container = document.getElementById('featured-products');
  const featured = products.slice(0, 8);
  container.innerHTML = featured.map(p => productCardHTML(p)).join('');
}

/* ────────────────────────────────────────
   RENDER SHOP PRODUCTS
──────────────────────────────────────── */
window.renderShopProducts = function() {
  renderCategoryFilters();
  filterProducts();
}

window.renderCategoryFilters = function() {
  const cats = [...new Set(products.map(p => p.cat))];
  const container = document.getElementById('category-filters');
  container.innerHTML = cats.map(cat => `
    <label class="filter-option">
      <input type="checkbox" id="cat-${cat}" value="${cat}" onchange="filterProducts()"/>
      <label for="cat-${cat}">${cat} (${products.filter(p => p.cat === cat).length})</label>
    </label>
  `).join('');
  
  if (selectedCategoryFilter) {
    const cb = document.getElementById('cat-' + selectedCategoryFilter);
    if (cb) cb.checked = true;
    selectedCategoryFilter = null;
  }
}

window.filterCategory = function(cat) {
  selectedCategoryFilter = cat;
  showPage('shop');
}

window.clearFilters = function() {
  document.querySelectorAll('#category-filters input').forEach(i => i.checked = false);
  document.getElementById('price-range').value = 3000;
  document.getElementById('search-input').value = '';
  document.getElementById('sort-select').value = 'default';
  document.querySelector('input[name="rating"][value="0"]').checked = true;
  filterProducts();
}

window.filterProducts = function() {
  const search = document.getElementById('search-input')?.value.toLowerCase() || '';
  const priceMax = parseInt(document.getElementById('price-range')?.value || 3000);
  const ratingMin = parseFloat(document.querySelector('input[name="rating"]:checked')?.value || 0);
  const sort = document.getElementById('sort-select')?.value || 'default';
  const selectedCats = [...document.querySelectorAll('#category-filters input:checked')].map(i => i.value);
  
  document.getElementById('price-max-label').textContent = '$' + priceMax.toLocaleString();
  
  let result = products.filter(p => {
    const matchSearch = p.name.toLowerCase().includes(search) || p.cat.toLowerCase().includes(search);
    const matchPrice = p.price <= priceMax;
    const matchRating = p.rating >= ratingMin;
    const matchCat = selectedCats.length === 0 || selectedCats.includes(p.cat);
    return matchSearch && matchPrice && matchRating && matchCat;
  });
  
  // Sort
  if (sort === 'price-low') result.sort((a, b) => a.price - b.price);
  if (sort === 'price-high') result.sort((a, b) => b.price - a.price);
  if (sort === 'rating') result.sort((a, b) => b.rating - a.rating);
  if (sort === 'name') result.sort((a, b) => a.name.localeCompare(b.name));
  
  document.getElementById('result-count').textContent = `Showing ${result.length} of ${products.length} products`;
  document.getElementById('shop-products').innerHTML = result.length
    ? result.map(p => productCardHTML(p)).join('')
    : '<div style="color:var(--gray);padding:4rem;text-align:center;grid-column:1/-1"><div style="font-size:4rem;margin-bottom:1rem">🔍</div><h3>No products found</h3><p>Try adjusting your filters or search terms</p></div>';
}

/* ────────────────────────────────────────
   PRODUCT CARD HTML
──────────────────────────────────────── */
window.productCardHTML = function(p) {
  const stars = Array(5).fill(0).map((_, i) => 
    i < Math.floor(p.rating) ? '<span class="star">★</span>' : '<span class="star empty">☆</span>'
  ).join('');
  
  const discount = p.oldPrice ? Math.round((1 - p.price / p.oldPrice) * 100) : 0;
  
  const isWishlisted = wishlist.find(w => w.id === p.id);
  
  return `
    <div class="product-card">
      ${p.badge ? `<div class="product-badge ${p.badge === 'Sale' ? 'sale' : ''} ${p.badge === 'New' ? 'new' : ''}">${p.badge}</div>` : ''}
      <div class="product-wishlist ${isWishlisted ? 'active' : ''}" onclick="addToWishlist(${p.id})">♡</div>
      <div class="product-img">
        <span>${p.icon}</span>
        <div class="product-actions">
          <button class="product-action-btn" onclick="openDetail(${p.id})">Quick View</button>
          <button class="product-action-btn primary" onclick="addToCart(${p.id})">Add to Cart</button>
        </div>
      </div>
      <div class="product-body">
        <div class="product-cat">${p.cat}</div>
        <div class="product-name">${p.name}</div>
        <div class="product-rating">
          <div class="stars">${stars}</div>
          <span class="rating-text">${p.rating} (${p.reviews})</span>
        </div>
        <div class="product-price">
          <span class="price-current">$${p.price.toLocaleString()}</span>
          ${p.oldPrice ? `<span class="price-old">$${p.oldPrice.toLocaleString()}</span>` : ''}
          ${discount > 0 ? `<span class="price-discount">-${discount}%</span>` : ''}
        </div>
      </div>
    </div>
  `;
}

/* ────────────────────────────────────────
   PRODUCT DETAIL
──────────────────────────────────────── */
window.openDetail = function(id) {
  currentDetailProduct = products.find(p => p.id === id);
  showPage('detail');
}

window.renderDetailPage = function() {
  const p = currentDetailProduct;
  if (!p) return;
  
  document.getElementById('detail-breadcrumb').textContent = p.name;
  document.getElementById('detail-cat').textContent = p.cat;
  document.getElementById('detail-name').textContent = p.name;
  document.getElementById('detail-price').textContent = '$' + p.price.toLocaleString();
  document.getElementById('detail-desc').textContent = p.desc;
  document.getElementById('detail-main-img').innerHTML = p.icon + '<div class="img-zoom">🔍</div>';
  document.getElementById('detail-rating-value').textContent = p.rating;
  document.getElementById('detail-reviews').textContent = `(${p.reviews} reviews)`;
  document.getElementById('detail-qty').value = 1;
  
  // Stars
  const starsHTML = Array(5).fill(0).map((_, i) => 
    i < Math.floor(p.rating) ? '<span class="star">★</span>' : '<span class="star empty">☆</span>'
  ).join('');
  document.getElementById('detail-stars').innerHTML = starsHTML;
  
  // Old price & discount
  const oldEl = document.getElementById('detail-old-price');
  const discountEl = document.getElementById('detail-discount');
  if (p.oldPrice) {
    oldEl.textContent = '$' + p.oldPrice.toLocaleString();
    const discount = Math.round((1 - p.price / p.oldPrice) * 100);
    discountEl.textContent = `-${discount}% OFF`;
  } else {
    oldEl.textContent = '';
    discountEl.textContent = '';
  }
  
  // Thumbs
  const thumbs = [p.icon, '🔄', '📐', '🏷️'];
  document.getElementById('detail-thumbs').innerHTML = thumbs.map((t, i) => `
    <div class="thumb ${i === 0 ? 'active' : ''}" onclick="setThumb(this,'${t}')">${t}</div>
  `).join('');
  
  // Reviews
  document.getElementById('reviews-list').innerHTML = reviews.map(r => `
    <div class="review-card">
      <div class="review-header">
        <div class="review-author">
          <div class="review-avatar">${r.initials}</div>
          <div>
            <div class="review-name">${r.name}</div>
            <div class="review-date">${r.date}</div>
          </div>
        </div>
        <div class="review-stars">${'<span class="star">★</span>'.repeat(r.rating)}</div>
      </div>
      <p class="review-text">${r.text}</p>
      ${r.verified ? '<div class="review-verified">✓ Verified Purchase</div>' : ''}
    </div>
  `).join('');
}

window.setThumb = function(el, icon) {
  document.querySelectorAll('.thumb').forEach(t => t.classList.remove('active'));
  el.classList.add('active');
  document.getElementById('detail-main-img').innerHTML = icon + '<div class="img-zoom">🔍</div>';
}

window.changeDetailQty = function(delta) {
  const input = document.getElementById('detail-qty');
  const val = Math.max(1, Math.min(10, parseInt(input.value) + delta));
  input.value = val;
}

window.addDetailToCart = function() {
  const qty = parseInt(document.getElementById('detail-qty').value);
  for (let i = 0; i < qty; i++) {
    addToCartSilent(currentDetailProduct.id);
  }
  showToast('Added to Cart', `${qty}x ${currentDetailProduct.name}`, 'success');
}

// Color & Size selection
document.addEventListener('click', function(e) {
  if (e.target.classList.contains('color-dot')) {
    document.querySelectorAll('.color-dot').forEach(d => d.classList.remove('active'));
    e.target.classList.add('active');
  }
  if (e.target.classList.contains('size-btn')) {
    document.querySelectorAll('.size-btn').forEach(b => b.classList.remove('active'));
    e.target.classList.add('active');
  }
});

/* ────────────────────────────────────────
   CART OPERATIONS
──────────────────────────────────────── */
window.addToCart = function(id) {
  const product = products.find(p => p.id === id);
  const existing = cart.find(i => i.id === id);
  if (existing) {
    existing.qty++;
  } else {
    cart.push({...product, qty: 1});
  }
  updateCartCount();
  showToast('Added to Cart', product.name, 'success');
}

window.addToCartSilent = function(id) {
  const product = products.find(p => p.id === id);
  const existing = cart.find(i => i.id === id);
  if (existing) {
    existing.qty++;
  } else {
    cart.push({...product, qty: 1});
  }
  updateCartCount();
}

window.removeFromCart = function(id) {
  const item = cart.find(i => i.id === id);
  cart = cart.filter(i => i.id !== id);
  updateCartCount();
  renderCart();
  showToast('Removed from Cart', item?.name || 'Item removed', 'info');
}

window.updateQty = function(id, delta) {
  const item = cart.find(i => i.id === id);
  if (!item) return;
  item.qty = Math.max(1, item.qty + delta);
  updateCartCount();
  renderCart();
}

window.updateCartCount = function() {
  const total = cart.reduce((sum, i) => sum + i.qty, 0);
  document.getElementById('cart-count').textContent = total;
}

window.getCartTotals = function() {
  const subtotal = cart.reduce((sum, i) => sum + i.price * i.qty, 0);
  const shipping = subtotal >= 100 ? 0 : 15;
  const tax = subtotal * 0.08;
  const total = subtotal + shipping + tax;
  return {subtotal, shipping, tax, total};
}

/* ────────────────────────────────────────
   RENDER CART PAGE
──────────────────────────────────────── */
window.renderCart = function() {
  const container = document.getElementById('cart-content');
  
  if (cart.length === 0) {
    container.innerHTML = `
      <div class="empty-cart">
        <div class="icon">🛒</div>
        <h3>Your cart is empty</h3>
        <p>Looks like you haven't added anything to your cart yet.</p>
        <button class="btn btn-gold btn-lg" onclick="showPage('shop')">Start Shopping</button>
      </div>`;
    return;
  }
  
  const {subtotal, shipping, tax, total} = getCartTotals();
  
  container.innerHTML = `
    <div>
      <div class="cart-items">
        <div class="cart-header">
          <span>Product</span>
          <span>Price</span>
          <span>Quantity</span>
          <span>Total</span>
          <span></span>
        </div>
        ${cart.map(item => `
          <div class="cart-row">
            <div class="cart-product">
              <div class="cart-img">${item.icon}</div>
              <div>
                <div class="cart-product-name">${item.name}</div>
                <div class="cart-product-meta">${item.cat}</div>
              </div>
            </div>
            <div class="cart-price">$${item.price.toLocaleString()}</div>
            <div>
              <div class="cart-qty-control">
                <button class="cart-qty-btn" onclick="updateQty(${item.id},-1)">−</button>
                <input class="cart-qty-val" value="${item.qty}" readonly/>
                <button class="cart-qty-btn" onclick="updateQty(${item.id},1)">+</button>
              </div>
            </div>
            <div class="cart-total">$${(item.price * item.qty).toLocaleString()}</div>
            <button class="cart-remove" onclick="removeFromCart(${item.id})">✕</button>
          </div>
        `).join('')}
      </div>
      <div class="cart-footer">
        <button class="btn btn-outline" onclick="showPage('shop')">← Continue Shopping</button>
        <button class="btn btn-dark" onclick="cart=[];updateCartCount();renderCart();showToast('Cart Cleared','All items removed','info')">Clear Cart</button>
      </div>
    </div>
    
    <div>
      <div class="cart-summary">
        <div class="summary-title">Order Summary</div>
        <div class="summary-row">
          <span class="label">Subtotal (${cart.reduce((s,i)=>s+i.qty,0)} items)</span>
          <span>$${subtotal.toLocaleString(undefined, {minimumFractionDigits:2})}</span>
        </div>
        <div class="summary-row">
          <span class="label">Shipping</span>
          <span>${shipping === 0 ? '<span class="text-green">FREE</span>' : '$' + shipping.toFixed(2)}</span>
        </div>
        <div class="summary-row">
          <span class="label">Tax (8%)</span>
          <span>$${tax.toLocaleString(undefined, {minimumFractionDigits:2})}</span>
        </div>
        <div class="summary-row total">
          <span class="label">Total</span>
          <span class="value">$${total.toLocaleString(undefined, {minimumFractionDigits:2})}</span>
        </div>
        <div class="promo-box">
          <div class="promo-input">
            <input type="text" placeholder="Enter promo code" id="promo-input"/>
            <button class="btn btn-dark btn-sm" onclick="applyPromo()">Apply</button>
          </div>
        </div>
        <button class="btn btn-gold w-full btn-lg" onclick="showPage('checkout')">
          Proceed to Checkout →
        </button>
        <div class="secure-badges">
          <div class="secure-badge">🔒 Secure Checkout</div>
          <div class="secure-badge">✓ SSL Encrypted</div>
        </div>
      </div>
    </div>
  `;
}

window.applyPromo = function() {
  const input = document.getElementById('promo-input') || document.getElementById('checkout-promo');
  const code = input?.value.trim().toUpperCase();
  
  if (code === 'LUXE10') {
    showToast('Promo Applied!', '10% discount added to your order', 'success');
  } else if (code === 'FREESHIP') {
    showToast('Promo Applied!', 'Free shipping unlocked', 'success');
  } else if (code) {
    showToast('Invalid Code', 'Please check your promo code', 'error');
  }
}

/* ────────────────────────────────────────
   RENDER CHECKOUT SUMMARY
──────────────────────────────────────── */
window.renderCheckoutSummary = function() {
  const {subtotal, shipping, tax, total} = getCartTotals();
  
  const itemsContainer = document.getElementById('checkout-order-items');
  itemsContainer.innerHTML = cart.length === 0
    ? '<p class="text-gray">No items in cart</p>'
    : cart.map(item => `
        <div class="order-item">
          <div class="order-item-img">${item.icon}</div>
          <div class="order-item-info">
            <div class="order-item-name">${item.name}</div>
            <div class="order-item-meta">Qty: ${item.qty}</div>
          </div>
          <div class="order-item-price">$${(item.price * item.qty).toLocaleString()}</div>
        </div>
      `).join('');
  
  document.getElementById('checkout-summary-totals').innerHTML = `
    <div class="summary-row"><span class="label">Subtotal</span><span>$${subtotal.toFixed(2)}</span></div>
    <div class="summary-row"><span class="label">Shipping</span><span>${shipping === 0 ? '<span class="text-green">FREE</span>' : '$' + shipping.toFixed(2)}</span></div>
    <div class="summary-row"><span class="label">Tax</span><span>$${tax.toFixed(2)}</span></div>
    <div class="summary-row total"><span class="label">Total</span><span class="value">$${total.toFixed(2)}</span></div>
  `;
}

/* ────────────────────────────────────────
   FORM VALIDATION & ORDER
──────────────────────────────────────── */
window.validateField = function(id, check) {
  const fg = document.getElementById('fg-' + id);
  const input = document.getElementById(id);
  if (!fg || !input) return true;
  
  if (!check(input.value)) {
    fg.classList.add('invalid');
    return false;
  }
  fg.classList.remove('invalid');
  return true;
}

window.placeOrder = function() {
  const checks = [
    validateField('fname', v => v.trim().length >= 2),
    validateField('lname', v => v.trim().length >= 2),
    validateField('email', v => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v)),
    validateField('phone', v => v.trim().length >= 7),
    validateField('address', v => v.trim().length >= 5),
    validateField('city', v => v.trim().length >= 2),
    validateField('zip', v => v.trim().length >= 3),
  ];
  
  if (cart.length === 0) {
    showToast('Cart is Empty', 'Please add items before checkout', 'error');
    return;
  }
  
  if (checks.every(Boolean)) {
    const orderId = '#ORD-' + Math.floor(Math.random() * 9000 + 1000);
    document.getElementById('order-id-display').textContent = orderId;
    cart = [];
    updateCartCount();
    openModal('order-success-modal');
  } else {
    showToast('Missing Information', 'Please fill in all required fields', 'error');
    const firstInvalid = document.querySelector('.form-group.invalid');
    if (firstInvalid) firstInvalid.scrollIntoView({behavior: 'smooth', block: 'center'});
  }
}

window.selectPayment = function(el) {
  document.querySelectorAll('.payment-option').forEach(o => {
    o.classList.remove('selected');
    o.querySelector('input').checked = false;
  });
  el.classList.add('selected');
  el.querySelector('input').checked = true;
}

/* ────────────────────────────────────────
   AUTH HANDLERS
──────────────────────────────────────── */
window.handleLogin = function(e) {
  e.preventDefault();
  const email = document.getElementById('login-email').value;
  const pass = document.getElementById('login-pass').value;
  
  if (email && pass.length >= 6) {
    showToast('Welcome Back!', 'Successfully logged in', 'success');
    showPage('home');
  } else {
    showToast('Login Failed', 'Please check your credentials', 'error');
  }
}

/* ────────────────────────────────────────
   NEWSLETTER
──────────────────────────────────────── */
window.handleNewsletter = function(e) {
  e.preventDefault();
  showToast('Subscribed!', 'Welcome to the LUXE newsletter', 'success');
  e.target.reset();
}

/* ────────────────────────────────────────
   ADMIN PANEL
──────────────────────────────────────── */
window.showAdminTab = function(tab, navEl) {
  ['dashboard', 'products', 'orders', 'users', 'analytics', 'settings'].forEach(t => {
    const el = document.getElementById('admin-' + t);
    if (el) el.style.display = t === tab ? 'block' : 'none';
  });
  
  if (navEl) {
    document.querySelectorAll('.admin-nav-item').forEach(i => i.classList.remove('active'));
    navEl.classList.add('active');
  }
  
  if (tab === 'products') renderAdminProducts();
}

window.renderAdminProducts = function() {
  const tbody = document.getElementById('admin-products-body');
  if (!tbody) return;
  
  document.getElementById('admin-product-count').textContent = products.length + ' products';
  document.getElementById('admin-total-products').textContent = products.length;
  
  tbody.innerHTML = products.map(p => `
    <tr>
      <td style="font-size:2rem">${p.icon}</td>
      <td><strong>${p.name}</strong></td>
      <td><span class="text-gold">${p.cat}</span></td>
      <td class="text-gold">$${p.price.toLocaleString()}</td>
      <td>${'★'.repeat(Math.floor(p.rating))} ${p.rating}</td>
      <td><span class="status-badge status-shipped">In Stock</span></td>
      <td>
        <div class="table-actions">
          <button class="action-btn action-edit" onclick="showToast('Edit Product','${p.name}','info')">Edit</button>
          <button class="action-btn action-del" onclick="deleteAdminProduct(${p.id})">Delete</button>
        </div>
      </td>
    </tr>
  `).join('');
}

window.deleteAdminProduct = function(id) {
  const idx = products.findIndex(p => p.id === id);
  if (idx > -1) {
    const name = products[idx].name;
    products.splice(idx, 1);
    renderAdminProducts();
    showToast('Product Deleted', name + ' has been removed', 'error');
  }
}

window.openAddProductModal = function() {
  openModal('add-product-modal');
}

window.handleAddProduct = function(e) {
  e.preventDefault();
  
  const name = document.getElementById('ap-name').value.trim();
  const price = parseFloat(document.getElementById('ap-price').value);
  const cat = document.getElementById('ap-category').value;
  const desc = document.getElementById('ap-desc').value;
  const icon = document.getElementById('ap-icon').value || '📦';
  const oldPrice = parseFloat(document.getElementById('ap-old-price').value) || null;
  
  if (!name || !price) {
    showToast('Missing Fields', 'Please fill in required fields', 'error');
    return;
  }
  
  const newProduct = {
    id: Date.now(),
    name, cat, price, oldPrice, rating: 0,
    reviews: 0, icon, badge: 'New', desc
  };
  
  products.push(newProduct);
  closeModal('add-product-modal');
  renderAdminProducts();
  showToast('Product Added', name + ' has been created', 'success');
  
  // Reset form
  e.target.reset();
}

/* ────────────────────────────────────────
   MODALS
──────────────────────────────────────── */
window.openModal = function(id) {
  document.getElementById(id).classList.add('open');
  document.body.style.overflow = 'hidden';
}

window.closeModal = function(id) {
  document.getElementById(id).classList.remove('open');
  document.body.style.overflow = '';
}

// Close modal on overlay click
document.querySelectorAll('.modal-overlay').forEach(overlay => {
  overlay.addEventListener('click', function(e) {
    if (e.target === this) {
      this.classList.remove('open');
      document.body.style.overflow = '';
    }
  });
});

/* ────────────────────────────────────────
   TOAST NOTIFICATIONS
──────────────────────────────────────── */
window.showToast = function(title, msg, type = 'info') {
  const icons = {success: '✓', error: '✕', info: 'ℹ'};
  const container = document.getElementById('toast-container');
  
  const toast = document.createElement('div');
  toast.className = `toast ${type}`;
  toast.innerHTML = `
    <div class="toast-icon">${icons[type]}</div>
    <div class="toast-content">
      <div class="toast-title">${title}</div>
      <div class="toast-msg">${msg}</div>
    </div>
    <button class="toast-close" onclick="this.parentElement.remove()">✕</button>
    <div class="toast-progress"><div class="toast-progress-bar"></div></div>
  `;
  
  container.appendChild(toast);
  
  setTimeout(() => {
    toast.classList.add('out');
    setTimeout(() => toast.remove(), 300);
  }, 3000);
}

/* ────────────────────────────────────────
   INITIALIZATION
──────────────────────────────────────── */
document.addEventListener('DOMContentLoaded', function() {
  // Wire nav buttons
  document.querySelectorAll('[data-page]').forEach(el => {
    el.style.cursor = 'pointer';
    el.addEventListener('click', function() {
      const page = this.getAttribute('data-page');
      if (page) showPage(page);
    });
  });
  
  // Hamburger
  const ham = document.getElementById('hamburger-btn');
  if (ham) {
    ham.addEventListener('click', function() {
      this.classList.toggle('active');
      document.getElementById('mobile-menu').classList.toggle('open');
    });
  }
  
  // Initialize
  renderFeaturedProducts();
  updateCartCount();
});

// Keyboard shortcuts
document.addEventListener('keydown', (e) => {
  if (e.key === 'Escape') {
    document.querySelectorAll('.modal-overlay.open').forEach(m => {
      m.classList.remove('open');
      document.body.style.overflow = '';
    });
    document.getElementById('wishlist-sidebar').classList.remove('open');
    document.getElementById('wishlist-overlay').classList.remove('open');
  }
});
</script>
</body>
</html>