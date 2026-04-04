<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

include 'configuration/database_connection.php';

$result = mysqli_query($conn, "SELECT * FROM product_detail ORDER BY id ASC");

if (!$result) {
    die("Database error: " . mysqli_error($conn));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>NOIR — Premium Store</title>
<style>
@import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300;400;600;700&family=DM+Sans:wght@300;400;500;600&display=swap');

:root {
  --bg:#0c0c0e; --bg2:#111115; --bg3:#18181d; --card:#141418;
  --border:rgba(255,255,255,0.07); --border2:rgba(255,255,255,0.12);
  --gold:#c8a97e; --gold2:#e8c99e; --white:#f0ede8; --gray:#6b6b75;
  --light:#a8a6a0; --red:#e05252; --green:#52c07a;
  --radius:4px; --radius2:12px;
  --shadow:0 20px 60px rgba(0,0,0,0.6);
  --tr:all 0.28s cubic-bezier(0.4,0,0.2,1);
}
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
html{scroll-behavior:smooth}
body{font-family:'DM Sans',sans-serif;background:var(--bg);color:var(--white);line-height:1.6;overflow-x:hidden}
a{text-decoration:none;color:inherit}
button{cursor:pointer;border:none;outline:none;font-family:inherit}
img{max-width:100%;display:block}
ul{list-style:none}
input,select,textarea{font-family:inherit;outline:none}
::-webkit-scrollbar{width:5px}
::-webkit-scrollbar-track{background:var(--bg)}
::-webkit-scrollbar-thumb{background:var(--gold);border-radius:2px}
body::before{content:'';position:fixed;inset:0;z-index:999;pointer-events:none;
  background-image:url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.04'/%3E%3C/svg%3E");
  opacity:0.4;}

/* ── PAGES ── */
.page{display:none}
.page.active{display:block}

/* ══════════ NAVBAR ══════════ */
.navbar{position:sticky;top:0;z-index:200;background:rgba(12,12,14,0.92);
  backdrop-filter:blur(24px);border-bottom:1px solid var(--border);
  padding:0 5%;display:flex;align-items:center;justify-content:space-between;height:68px;}
.nav-logo{font-family:'Cormorant Garamond',serif;font-size:1.8rem;font-weight:700;
  letter-spacing:0.22em;text-transform:uppercase;color:var(--gold);flex-shrink:0;cursor:pointer;}
.nav-logo span{color:var(--white);font-weight:300}
.nav-search{display:flex;align-items:center;gap:0.5rem;background:var(--bg3);
  border:1px solid var(--border2);border-radius:var(--radius);padding:0.45rem 1rem;
  width:260px;transition:var(--tr);}
.nav-search:focus-within{border-color:var(--gold);box-shadow:0 0 0 3px rgba(200,169,126,0.1)}
.nav-search input{background:none;border:none;color:var(--white);font-size:0.83rem;width:100%}
.nav-search input::placeholder{color:var(--gray)}
.nav-right{display:flex;align-items:center;gap:0.6rem}
.nav-icon{position:relative;width:40px;height:40px;background:var(--bg3);
  border:1px solid var(--border);border-radius:var(--radius);
  display:flex;align-items:center;justify-content:center;
  transition:var(--tr);color:var(--light);font-size:1rem;}
.nav-icon:hover{border-color:var(--gold);color:var(--gold)}
.nav-badge{position:absolute;top:-6px;right:-6px;background:var(--gold);color:#000;
  font-size:0.6rem;font-weight:700;width:17px;height:17px;border-radius:50%;
  display:flex;align-items:center;justify-content:center;}
.hamburger{display:none;flex-direction:column;gap:4px;background:none;padding:8px}
.hamburger span{width:22px;height:1.5px;background:var(--white);border-radius:2px;transition:var(--tr)}

/* ══════════ MOBILE NAV ══════════ */
.mobile-nav{display:none;position:fixed;inset:0;z-index:300;
  background:rgba(12,12,14,0.98);flex-direction:column;align-items:center;
  justify-content:center;gap:2rem;}
.mobile-nav.open{display:flex}
.mobile-nav a{font-family:'Cormorant Garamond',serif;font-size:2rem;font-weight:300;
  letter-spacing:0.1em;text-transform:uppercase;color:var(--light);transition:var(--tr);cursor:pointer;}
.mobile-nav a:hover{color:var(--gold)}
.mnav-close{position:absolute;top:1.5rem;right:5%;background:none;color:var(--light);
  font-size:1.6rem;transition:var(--tr);}
.mnav-close:hover{color:var(--gold)}

/* ══════════ BUTTONS ══════════ */
.btn{display:inline-flex;align-items:center;justify-content:center;gap:0.5rem;
  padding:0.72rem 1.8rem;font-size:0.78rem;letter-spacing:0.12em;text-transform:uppercase;
  font-weight:500;transition:var(--tr);border-radius:var(--radius);}
.btn-gold{background:var(--gold);color:#000}
.btn-gold:hover{background:var(--gold2);transform:translateY(-2px);box-shadow:0 8px 24px rgba(200,169,126,0.35)}
.btn-ghost{background:transparent;color:var(--light);border:1px solid var(--border2)}
.btn-ghost:hover{border-color:var(--gold);color:var(--gold)}
.btn-red{background:var(--red);color:#fff}
.btn-red:hover{opacity:0.85}
.btn-sm{padding:0.5rem 1.2rem;font-size:0.72rem}
.btn-full{width:100%}

/* ══════════ HERO ══════════ */
.hero{min-height:88vh;display:flex;align-items:center;position:relative;
  overflow:hidden;padding:6rem 5%;background:var(--bg);}
.hero::after{content:'';position:absolute;right:0;top:0;bottom:0;width:55%;
  background:linear-gradient(135deg,#1a1208 0%,#0c0c0e 100%);
  clip-path:polygon(8% 0,100% 0,100% 100%,0 100%);}
.hero-mesh{position:absolute;right:5%;top:50%;transform:translateY(-50%);
  width:min(48%,580px);z-index:2;display:grid;grid-template-columns:1fr 1fr;gap:1rem;}
.hero-mesh-card{background:var(--card);border:1px solid var(--border2);
  border-radius:var(--radius2);overflow:hidden;animation:fadeUp 1s ease both;}
.hero-mesh-card:nth-child(2){animation-delay:.15s;margin-top:2rem}
.hero-mesh-card:nth-child(3){animation-delay:.3s}
.hero-mesh-card:nth-child(4){animation-delay:.45s;margin-top:2rem}
.hero-mesh-card img{width:100%;height:140px;object-fit:cover;filter:brightness(0.85)}
.hero-mesh-card-body{padding:.75rem}
.hero-mesh-card-body p{font-size:.72rem;color:var(--light);margin-bottom:.2rem}
.hero-mesh-card-body span{font-size:.88rem;color:var(--gold);font-weight:600}
@keyframes fadeUp{from{opacity:0;transform:translateY(30px)}to{opacity:1;transform:translateY(0)}}
.hero-content{max-width:520px;z-index:3;animation:fadeUp .8s ease}
.hero-eyebrow{display:inline-flex;align-items:center;gap:.6rem;
  background:rgba(200,169,126,0.1);border:1px solid rgba(200,169,126,0.25);
  padding:.3rem .9rem;border-radius:50px;font-size:.72rem;letter-spacing:.2em;
  text-transform:uppercase;color:var(--gold);margin-bottom:1.8rem;}
.hero-eyebrow::before{content:'●';font-size:.5rem;animation:pulse 2s infinite}
@keyframes pulse{0%,100%{opacity:1}50%{opacity:0.3}}
.hero h1{font-family:'Cormorant Garamond',serif;font-size:clamp(3rem,6vw,5.5rem);
  font-weight:300;line-height:1.05;margin-bottom:1.5rem;}
.hero h1 em{font-style:italic;color:var(--gold)}
.hero-sub{color:var(--gray);font-size:.95rem;margin-bottom:2.5rem;max-width:380px;line-height:1.8}
.hero-btns{display:flex;gap:.75rem;flex-wrap:wrap}

/* ══════════ MARQUEE ══════════ */
.marquee-bar{background:var(--gold);overflow:hidden;white-space:nowrap;padding:.6rem 0}
.marquee-track{display:inline-flex;gap:3rem;animation:marquee 18s linear infinite}
@keyframes marquee{from{transform:translateX(0)}to{transform:translateX(-50%)}}
.marquee-item{font-size:.72rem;letter-spacing:.2em;text-transform:uppercase;
  color:#000;font-weight:600;display:flex;align-items:center;gap:1rem;}
.marquee-item::after{content:'✦';font-size:.55rem}

/* ══════════ SECTIONS ══════════ */
.section{padding:6rem 5%}
.section-header{margin-bottom:3.5rem}
.section-eyebrow{font-size:.7rem;letter-spacing:.25em;text-transform:uppercase;
  color:var(--gold);margin-bottom:.6rem;display:flex;align-items:center;gap:.6rem;}
.section-eyebrow::before{content:'';width:24px;height:1px;background:var(--gold)}
.section-title{font-family:'Cormorant Garamond',serif;font-size:clamp(2rem,4vw,3rem);
  font-weight:400;color:var(--white);line-height:1.1;}

/* ══════════ CATEGORIES ══════════ */
.categories-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(140px,1fr));gap:1rem}
.category-card{background:var(--card);border:1px solid var(--border);border-radius:var(--radius2);
  padding:1.8rem 1rem;text-align:center;cursor:pointer;transition:var(--tr);position:relative;overflow:hidden;}
.category-card::before{content:'';position:absolute;inset:0;
  background:linear-gradient(135deg,rgba(200,169,126,0.06),transparent);opacity:0;transition:var(--tr);}
.category-card:hover{border-color:rgba(200,169,126,0.4);transform:translateY(-4px)}
.category-card:hover::before{opacity:1}
.cat-icon{font-size:2rem;margin-bottom:.75rem}
.cat-name{font-size:.78rem;letter-spacing:.1em;text-transform:uppercase;color:var(--light);font-weight:500}
.cat-count{font-size:.68rem;color:var(--gray);margin-top:.3rem}

/* ══════════ PRODUCT CARDS ══════════ */
.products-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(260px,1fr));gap:1.5rem}
.product-card{background:var(--card);border:1px solid var(--border);border-radius:var(--radius2);
  overflow:hidden;transition:var(--tr);position:relative;cursor:pointer;}
.product-card:hover{transform:translateY(-6px);border-color:rgba(200,169,126,0.3);
  box-shadow:0 24px 48px rgba(0,0,0,0.5);}
.product-badge{position:absolute;top:12px;left:12px;z-index:2;
  font-size:.65rem;font-weight:700;letter-spacing:.12em;text-transform:uppercase;
  padding:3px 10px;border-radius:50px;}
.badge-new{background:var(--gold);color:#000}
.badge-sale{background:var(--red);color:#fff}
.badge-hot{background:#e08a52;color:#fff}
.badge-limited{background:#7c52e0;color:#fff}
.product-img{width:100%;height:240px;position:relative;overflow:hidden;background:var(--bg3)}
.product-img img{width:100%;height:100%;object-fit:cover;
  transition:transform .5s cubic-bezier(.4,0,.2,1);filter:brightness(0.9);}
.product-card:hover .product-img img{transform:scale(1.06)}
.product-overlay{position:absolute;inset:0;background:rgba(0,0,0,0.55);
  display:flex;align-items:center;justify-content:center;opacity:0;transition:var(--tr);gap:.6rem;}
.product-card:hover .product-overlay{opacity:1}
.overlay-btn{background:rgba(255,255,255,0.95);color:#000;border:none;
  padding:.55rem 1.1rem;border-radius:var(--radius);
  font-size:.72rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;
  cursor:pointer;transition:var(--tr);font-family:'DM Sans',sans-serif;}
.overlay-btn:hover{background:var(--gold)}
.product-body{padding:1.25rem}
.product-cat{font-size:.68rem;letter-spacing:.15em;text-transform:uppercase;color:var(--gold);margin-bottom:.4rem}
.product-name{font-family:'Cormorant Garamond',serif;font-size:1.15rem;font-weight:600;
  color:var(--white);margin-bottom:.5rem;line-height:1.3;}
.product-stars{display:flex;align-items:center;gap:.4rem;margin-bottom:.75rem}
.stars-row{color:var(--gold);font-size:.75rem;letter-spacing:1px}
.stars-count{color:var(--gray);font-size:.72rem}
.product-price-row{display:flex;align-items:center;justify-content:space-between}
.product-price{display:flex;align-items:baseline;gap:.6rem}
.price-now{font-size:1.2rem;font-weight:700;color:var(--gold)}
.price-was{font-size:.85rem;color:var(--gray);text-decoration:line-through}
.add-btn{width:36px;height:36px;background:var(--bg3);border:1px solid var(--border2);
  border-radius:var(--radius);display:flex;align-items:center;justify-content:center;
  color:var(--light);font-size:1.1rem;transition:var(--tr);}
.add-btn:hover{background:var(--gold);border-color:var(--gold);color:#000}
.product-card.hidden{display:none}
.no-results{grid-column:1/-1;text-align:center;padding:4rem;color:var(--gray);font-size:.95rem}

/* ══════════ BANNER ══════════ */
.banner{margin:0 5% 6rem;border-radius:20px;
  background:linear-gradient(135deg,#1a1208 0%,#0f0f13 60%);
  border:1px solid var(--border2);padding:5rem;
  display:grid;grid-template-columns:1fr 1fr;gap:4rem;align-items:center;
  position:relative;overflow:hidden;}
.banner::before{content:'';position:absolute;right:-80px;top:-80px;width:360px;height:360px;
  background:radial-gradient(circle,rgba(200,169,126,0.12) 0%,transparent 70%);border-radius:50%;}
.banner::after{content:'NOIR';position:absolute;right:5%;bottom:-1rem;
  font-family:'Cormorant Garamond',serif;font-size:10rem;font-weight:700;
  color:rgba(200,169,126,0.04);line-height:1;pointer-events:none;user-select:none;}
.banner-eyebrow{font-size:.7rem;letter-spacing:.25em;text-transform:uppercase;color:var(--gold);margin-bottom:1rem}
.banner h2{font-family:'Cormorant Garamond',serif;font-size:clamp(2rem,4vw,3.2rem);
  font-weight:300;line-height:1.1;margin-bottom:1.2rem;}
.banner p{color:var(--gray);font-size:.92rem;line-height:1.9;margin-bottom:2rem;max-width:380px}
.banner-perks{display:flex;flex-direction:column;gap:.7rem;margin-bottom:2.2rem}
.banner-perk{display:flex;align-items:center;gap:.75rem;font-size:.88rem;color:var(--light)}
.banner-perk::before{content:'—';color:var(--gold);font-weight:700;flex-shrink:0}
.banner-visual{border-radius:16px;overflow:hidden;height:360px;position:relative;box-shadow:var(--shadow)}
.banner-visual img{width:100%;height:100%;object-fit:cover;filter:brightness(0.85)}
.banner-visual-overlay{position:absolute;bottom:0;left:0;right:0;
  background:linear-gradient(transparent,rgba(0,0,0,0.6));padding:1.5rem;}
.banner-visual-tag{background:var(--gold);color:#000;font-size:.7rem;font-weight:700;
  letter-spacing:.1em;text-transform:uppercase;padding:4px 12px;border-radius:50px;
  display:inline-block;margin-bottom:.5rem;}
.banner-visual-title{font-family:'Cormorant Garamond',serif;font-size:1.3rem;font-weight:600}

/* ══════════ STATS ══════════ */
.stats{background:var(--bg2);border-top:1px solid var(--border);border-bottom:1px solid var(--border);
  padding:3rem 5%;display:grid;grid-template-columns:repeat(4,1fr);gap:2rem;text-align:center;}
.stat-value{font-family:'Cormorant Garamond',serif;font-size:2.5rem;font-weight:700;color:var(--gold)}
.stat-label{font-size:.72rem;letter-spacing:.15em;text-transform:uppercase;color:var(--gray);margin-top:.3rem}

/* ══════════ NEWSLETTER ══════════ */
.newsletter{background:var(--bg2);padding:5rem;text-align:center;
  border-top:1px solid var(--border);border-bottom:1px solid var(--border);}
.newsletter h2{font-family:'Cormorant Garamond',serif;font-size:clamp(2rem,4vw,3rem);
  font-weight:300;margin-bottom:.75rem;}
.newsletter p{color:var(--gray);margin-bottom:2rem;font-size:.92rem}
.newsletter-form{display:flex;max-width:440px;margin:0 auto;
  border:1px solid var(--border2);border-radius:var(--radius);overflow:hidden;transition:var(--tr);}
.newsletter-form:focus-within{border-color:var(--gold);box-shadow:0 0 0 3px rgba(200,169,126,0.1)}
.newsletter-form input{flex:1;background:var(--bg3);border:none;color:var(--white);
  padding:.85rem 1.2rem;font-size:.88rem;}
.newsletter-form input::placeholder{color:var(--gray)}
.newsletter-form button{background:var(--gold);color:#000;padding:.85rem 1.5rem;
  font-size:.75rem;font-weight:700;letter-spacing:.12em;text-transform:uppercase;transition:var(--tr);}
.newsletter-form button:hover{background:var(--gold2)}

/* ══════════ FOOTER ══════════ */
footer{background:var(--bg);padding:5rem 5% 2.5rem;border-top:1px solid var(--border)}
.footer-grid{display:grid;grid-template-columns:2.5fr 1fr 1fr 1fr;gap:4rem;margin-bottom:4rem}
.footer-logo{font-family:'Cormorant Garamond',serif;font-size:1.6rem;font-weight:700;
  letter-spacing:.2em;color:var(--gold);text-transform:uppercase;margin-bottom:1rem;}
.footer-brand p{color:var(--gray);font-size:.85rem;line-height:1.8;max-width:280px;margin-bottom:1.5rem}
.social-row{display:flex;gap:.6rem}
.social-btn{width:36px;height:36px;background:var(--bg3);border:1px solid var(--border);
  border-radius:var(--radius);display:flex;align-items:center;justify-content:center;
  font-size:.85rem;color:var(--light);transition:var(--tr);}
.social-btn:hover{border-color:var(--gold);color:var(--gold)}
.footer-col h5{font-size:.72rem;letter-spacing:.2em;text-transform:uppercase;
  color:var(--white);margin-bottom:1.2rem;font-weight:600;}
.footer-col ul li{margin-bottom:.65rem}
.footer-col ul li a{color:var(--gray);font-size:.85rem;transition:var(--tr);cursor:pointer}
.footer-col ul li a:hover{color:var(--gold)}
.footer-bottom{border-top:1px solid var(--border);padding-top:2rem;
  display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:1rem;}
.footer-bottom p{color:var(--gray);font-size:.8rem}

/* ══════════ CART DRAWER ══════════ */
.overlay-bg{position:fixed;inset:0;background:rgba(0,0,0,0.6);z-index:400;
  opacity:0;pointer-events:none;transition:opacity .3s;}
.overlay-bg.open{opacity:1;pointer-events:all}
.cart-drawer{position:fixed;top:0;right:0;bottom:0;width:380px;background:var(--bg2);
  border-left:1px solid var(--border2);z-index:500;
  transform:translateX(100%);transition:transform .35s cubic-bezier(.4,0,.2,1);
  display:flex;flex-direction:column;}
.cart-drawer.open{transform:translateX(0)}
.drawer-head{display:flex;align-items:center;justify-content:space-between;
  padding:1.5rem 1.5rem 1rem;border-bottom:1px solid var(--border);}
.drawer-head h3{font-family:'Cormorant Garamond',serif;font-size:1.3rem;font-weight:600}
.drawer-close{background:none;color:var(--gray);font-size:1.4rem;transition:var(--tr)}
.drawer-close:hover{color:var(--white)}
.cart-empty-state{flex:1;display:flex;flex-direction:column;align-items:center;
  justify-content:center;color:var(--gray);gap:1rem;padding:2rem;text-align:center;}
.cart-empty-icon{font-size:3.5rem;opacity:.4}
.cart-items-list{flex:1;overflow-y:auto;padding:1rem 1.5rem}
.cart-item{display:flex;gap:1rem;padding:1rem 0;border-bottom:1px solid var(--border);animation:fadeUp .3s ease}
.cart-item-img{width:64px;height:64px;border-radius:6px;overflow:hidden;background:var(--bg3);flex-shrink:0}
.cart-item-img img{width:100%;height:100%;object-fit:cover}
.cart-item-info{flex:1}
.cart-item-name{font-size:.88rem;margin-bottom:.2rem}
.cart-item-price{font-size:.82rem;color:var(--gold)}
.cart-item-remove{background:none;color:var(--gray);font-size:1rem;transition:var(--tr);align-self:center}
.cart-item-remove:hover{color:var(--red)}
.cart-footer-panel{padding:1.5rem;border-top:1px solid var(--border)}
.cart-total-row{display:flex;justify-content:space-between;margin-bottom:1.2rem;font-size:.92rem}
.cart-total-row strong{color:var(--gold);font-size:1.1rem}

/* ══════════ WISHLIST DRAWER ══════════ */
.wish-drawer{position:fixed;top:0;right:0;bottom:0;width:380px;background:var(--bg2);
  border-left:1px solid var(--border2);z-index:500;
  transform:translateX(100%);transition:transform .35s cubic-bezier(.4,0,.2,1);
  display:flex;flex-direction:column;}
.wish-drawer.open{transform:translateX(0)}
.wish-items-list{flex:1;overflow-y:auto;padding:1rem 1.5rem}
.wish-item{display:flex;gap:1rem;padding:1rem 0;border-bottom:1px solid var(--border);align-items:center}
.wish-item-img{width:64px;height:64px;border-radius:6px;overflow:hidden;background:var(--bg3);flex-shrink:0}
.wish-item-img img{width:100%;height:100%;object-fit:cover}
.wish-item-info{flex:1}
.wish-item-name{font-size:.88rem;margin-bottom:.2rem}
.wish-item-price{font-size:.82rem;color:var(--gold)}
.wish-item-actions{display:flex;flex-direction:column;gap:.4rem}
.wish-add-btn{background:var(--gold);color:#000;padding:.35rem .7rem;border-radius:var(--radius);
  font-size:.65rem;font-weight:700;letter-spacing:.08em;text-transform:uppercase;transition:var(--tr);}
.wish-add-btn:hover{background:var(--gold2)}
.wish-remove-btn{background:none;color:var(--gray);font-size:.85rem;transition:var(--tr)}
.wish-remove-btn:hover{color:var(--red)}

/* ══════════ MODAL ══════════ */
.modal-wrap{position:fixed;inset:0;z-index:600;display:flex;align-items:center;
  justify-content:center;padding:1rem;background:rgba(0,0,0,0.7);
  opacity:0;pointer-events:none;transition:opacity .25s;}
.modal-wrap.open{opacity:1;pointer-events:all}
.modal-box{background:var(--bg2);border:1px solid var(--border2);border-radius:20px;
  width:100%;max-width:480px;padding:2.5rem;box-shadow:var(--shadow);
  transform:scale(.95);transition:transform .25s;}
.modal-wrap.open .modal-box{transform:scale(1)}
.modal-head{display:flex;align-items:center;justify-content:space-between;margin-bottom:2rem}
.modal-head h3{font-family:'Cormorant Garamond',serif;font-size:1.5rem;font-weight:600}
.modal-close-btn{background:none;color:var(--gray);font-size:1.4rem;transition:var(--tr)}
.modal-close-btn:hover{color:var(--white)}

/* ══════════ AUTH FORMS ══════════ */
.auth-tabs{display:flex;border-bottom:1px solid var(--border);margin-bottom:1.8rem}
.auth-tab{flex:1;padding:.75rem;text-align:center;font-size:.78rem;letter-spacing:.1em;
  text-transform:uppercase;color:var(--gray);cursor:pointer;
  border-bottom:2px solid transparent;transition:var(--tr);}
.auth-tab.active{color:var(--gold);border-bottom-color:var(--gold)}
.auth-panel{display:none}
.auth-panel.active{display:block}
.form-group{margin-bottom:1.2rem}
.form-label{font-size:.72rem;letter-spacing:.1em;text-transform:uppercase;
  color:var(--gray);display:block;margin-bottom:.5rem;}
.form-input{width:100%;background:var(--bg3);border:1px solid var(--border2);
  color:var(--white);padding:.75rem 1rem;border-radius:var(--radius);
  font-size:.9rem;transition:var(--tr);}
.form-input:focus{border-color:var(--gold);box-shadow:0 0 0 3px rgba(200,169,126,0.1)}
.form-input::placeholder{color:var(--gray)}
.form-row{display:grid;grid-template-columns:1fr 1fr;gap:1rem}
.form-link{font-size:.8rem;color:var(--gold);cursor:pointer}
.form-link:hover{text-decoration:underline}
.form-divider{text-align:center;color:var(--gray);font-size:.78rem;
  margin:.75rem 0;position:relative;}
.form-divider::before,.form-divider::after{content:'';position:absolute;top:50%;width:42%;height:1px;background:var(--border)}
.form-divider::before{left:0}
.form-divider::after{right:0}
.auth-footer-text{text-align:center;font-size:.82rem;color:var(--gray);margin-top:1.2rem}

/* ══════════ PRODUCT DETAIL PAGE ══════════ */
.page-hero{background:linear-gradient(135deg,var(--bg),var(--bg2));
  padding:3rem 5% 2rem;border-bottom:1px solid var(--border);}
.breadcrumb{display:flex;align-items:center;gap:.5rem;font-size:.78rem;color:var(--gray);margin-bottom:.5rem}
.breadcrumb span{cursor:pointer;transition:var(--tr)}
.breadcrumb span:hover{color:var(--gold)}
.breadcrumb-sep{color:var(--border2)}
.detail-layout{display:grid;grid-template-columns:1fr 1fr;gap:4rem;padding:4rem 5%}
.detail-gallery .main-img{width:100%;height:480px;background:var(--bg3);
  border-radius:var(--radius2);overflow:hidden;border:1px solid var(--border);margin-bottom:1rem;}
.detail-gallery .main-img img{width:100%;height:100%;object-fit:cover}
.thumbs-row{display:flex;gap:.75rem}
.thumb{width:80px;height:80px;background:var(--card);border:1px solid var(--border);
  border-radius:8px;overflow:hidden;cursor:pointer;transition:var(--tr);}
.thumb img{width:100%;height:100%;object-fit:cover}
.thumb.active,.thumb:hover{border-color:var(--gold)}
.detail-info{padding-top:1rem}
.detail-cat{font-size:.7rem;color:var(--gold);letter-spacing:.15em;text-transform:uppercase;margin-bottom:.75rem}
.detail-name{font-family:'Cormorant Garamond',serif;font-size:clamp(1.8rem,3vw,2.5rem);
  font-weight:400;margin-bottom:1rem;}
.detail-rating{display:flex;align-items:center;gap:1rem;margin-bottom:1.5rem}
.detail-price{margin-bottom:1.5rem}
.detail-price-now{font-family:'Cormorant Garamond',serif;font-size:2.2rem;
  font-weight:700;color:var(--gold);}
.detail-price-was{color:var(--gray);text-decoration:line-through;font-size:1rem;margin-left:.75rem}
.detail-desc{color:var(--gray);font-size:.92rem;line-height:1.9;
  margin-bottom:1.5rem;padding-bottom:1.5rem;border-bottom:1px solid var(--border);}
.option-label{font-size:.72rem;letter-spacing:.1em;text-transform:uppercase;
  color:var(--light);margin-bottom:.75rem;display:block;}
.color-row{display:flex;gap:.75rem;margin-bottom:1.5rem}
.color-dot{width:28px;height:28px;border-radius:50%;cursor:pointer;
  border:2px solid transparent;transition:var(--tr);}
.color-dot.active,.color-dot:hover{border-color:var(--white);transform:scale(1.15)}
.size-row{display:flex;gap:.5rem;flex-wrap:wrap;margin-bottom:1.5rem}
.size-btn{padding:.4rem .9rem;background:var(--card);border:1px solid var(--border);
  border-radius:var(--radius);font-size:.82rem;color:var(--gray);cursor:pointer;transition:var(--tr);}
.size-btn.active,.size-btn:hover{border-color:var(--gold);color:var(--gold)}
.qty-row{display:flex;align-items:center;gap:1.5rem;margin-bottom:2rem}
.qty-ctrl{display:flex;align-items:center;background:var(--card);
  border:1px solid var(--border);border-radius:var(--radius);overflow:hidden;}
.qty-btn{background:none;color:var(--white);width:40px;height:40px;font-size:1.2rem;transition:var(--tr)}
.qty-btn:hover{background:var(--border)}
.qty-val{width:50px;text-align:center;font-size:1rem;color:var(--white);background:none;border:none}
.detail-action-row{display:flex;gap:1rem;flex-wrap:wrap}
.wishlist-btn{width:44px;height:44px;background:var(--bg3);border:1px solid var(--border2);
  border-radius:var(--radius);display:flex;align-items:center;justify-content:center;
  font-size:1.2rem;transition:var(--tr);flex-shrink:0;}
.wishlist-btn:hover{border-color:var(--red);color:var(--red)}
.detail-features{display:grid;grid-template-columns:1fr 1fr;gap:.75rem;margin-top:1.5rem}
.detail-feature{display:flex;align-items:center;gap:.6rem;font-size:.82rem;color:var(--light)}
.detail-feature-icon{color:var(--gold)}
.reviews-section{padding:4rem 5%;border-top:1px solid var(--border)}
.review-card{background:var(--card);border:1px solid var(--border);
  border-radius:var(--radius2);padding:1.5rem;margin-bottom:1rem;}
.review-head{display:flex;align-items:center;justify-content:space-between;margin-bottom:.75rem}
.reviewer-name{font-weight:600;font-size:.9rem}
.review-date{color:var(--gray);font-size:.78rem}
.review-text{color:var(--gray);font-size:.9rem;line-height:1.7}

/* ══════════ PROFILE PAGE ══════════ */
.profile-layout{display:grid;grid-template-columns:260px 1fr;gap:2rem;padding:3rem 5%}
.profile-sidebar{position:sticky;top:90px;height:fit-content}
.profile-card{background:var(--card);border:1px solid var(--border);
  border-radius:var(--radius2);padding:2rem;text-align:center;margin-bottom:1.5rem;}
.profile-avatar{width:80px;height:80px;background:linear-gradient(135deg,var(--gold),#8a6a3a);
  border-radius:50%;display:flex;align-items:center;justify-content:center;
  font-size:2rem;margin:0 auto 1rem;}
.profile-name{font-family:'Cormorant Garamond',serif;font-size:1.3rem;margin-bottom:.25rem}
.profile-email{font-size:.82rem;color:var(--gray)}
.profile-nav{background:var(--card);border:1px solid var(--border);border-radius:var(--radius2);overflow:hidden}
.profile-nav-item{display:flex;align-items:center;gap:.75rem;padding:.9rem 1.5rem;
  font-size:.85rem;color:var(--gray);cursor:pointer;transition:var(--tr);
  border-left:3px solid transparent;}
.profile-nav-item:hover,.profile-nav-item.active{color:var(--gold);
  background:rgba(200,169,126,0.06);border-left-color:var(--gold);}
.profile-nav-icon{font-size:1rem;width:20px;text-align:center}
.profile-content{min-height:400px}
.profile-panel{display:none}
.profile-panel.active{display:block}
.profile-panel-title{font-family:'Cormorant Garamond',serif;font-size:1.6rem;
  margin-bottom:1.5rem;padding-bottom:1rem;border-bottom:1px solid var(--border);}
.info-grid{display:grid;grid-template-columns:1fr 1fr;gap:1.2rem;margin-bottom:2rem}
.order-row{background:var(--card);border:1px solid var(--border);border-radius:var(--radius2);
  padding:1.25rem 1.5rem;display:flex;align-items:center;gap:1.5rem;margin-bottom:.75rem;
  transition:var(--tr);}
.order-row:hover{border-color:rgba(200,169,126,0.3)}
.order-id{font-size:.78rem;color:var(--gold);letter-spacing:.08em;margin-bottom:.2rem}
.order-date{font-size:.78rem;color:var(--gray)}
.order-name{font-size:.9rem;margin-bottom:.2rem}
.order-total{font-weight:700;color:var(--gold);margin-left:auto;white-space:nowrap}
.order-status{padding:.25rem .75rem;border-radius:50px;font-size:.68rem;
  font-weight:700;letter-spacing:.08em;text-transform:uppercase;white-space:nowrap;}
.status-delivered{background:rgba(82,192,122,0.15);color:var(--green)}
.status-shipped{background:rgba(100,180,246,0.15);color:#64b5f6}
.status-processing{background:rgba(255,165,0,0.15);color:orange}
.addr-card{background:var(--card);border:1px solid var(--border);border-radius:var(--radius2);
  padding:1.5rem;margin-bottom:.75rem;}
.addr-label{font-size:.7rem;letter-spacing:.15em;text-transform:uppercase;
  color:var(--gold);margin-bottom:.5rem;}
.addr-text{font-size:.88rem;color:var(--light);line-height:1.7}
.addr-actions{display:flex;gap:.5rem;margin-top:.75rem}
.addr-btn{font-size:.72rem;color:var(--gray);padding:.3rem .6rem;
  border:1px solid var(--border);border-radius:var(--radius);transition:var(--tr);}
.addr-btn:hover{border-color:var(--gold);color:var(--gold)}

/* ══════════ CHECKOUT PAGE ══════════ */
.checkout-layout{display:grid;grid-template-columns:1fr 380px;gap:2rem;padding:3rem 5%;align-items:start}
.checkout-box{background:var(--card);border:1px solid var(--border);
  border-radius:var(--radius2);padding:2rem;margin-bottom:1.5rem;}
.checkout-box-title{font-size:.78rem;letter-spacing:.15em;text-transform:uppercase;
  color:var(--gold);margin-bottom:1.5rem;padding-bottom:.75rem;border-bottom:1px solid var(--border);}
.payment-opts{display:flex;flex-direction:column;gap:.75rem}
.payment-opt{display:flex;align-items:center;gap:1rem;background:var(--bg3);
  border:1px solid var(--border2);border-radius:var(--radius);padding:1rem;cursor:pointer;transition:var(--tr);}
.payment-opt.selected,.payment-opt:has(input:checked){border-color:var(--gold)}
.payment-opt input{accent-color:var(--gold)}
.checkout-summary{background:var(--card);border:1px solid var(--border);
  border-radius:var(--radius2);padding:1.5rem;position:sticky;top:90px;}
.checkout-summary-title{font-family:'Cormorant Garamond',serif;font-size:1.1rem;
  margin-bottom:1.5rem;padding-bottom:1rem;border-bottom:1px solid var(--border);}
.summary-item{display:flex;align-items:center;gap:.75rem;padding:.75rem 0;border-bottom:1px solid var(--border)}
.summary-item-img{width:48px;height:48px;background:var(--bg3);border-radius:6px;overflow:hidden;flex-shrink:0}
.summary-item-img img{width:100%;height:100%;object-fit:cover}
.summary-item-info{flex:1;font-size:.82rem}
.summary-item-price{font-size:.85rem;color:var(--gold);font-weight:600;white-space:nowrap}
.sum-row{display:flex;justify-content:space-between;font-size:.88rem;margin-top:.75rem}
.sum-row .lbl{color:var(--gray)}
.sum-row.total{font-size:1rem;font-weight:700;margin-top:1rem;
  padding-top:.75rem;border-top:1px solid var(--border);}
.sum-row.total .val{color:var(--gold)}

/* ══════════ TOAST ══════════ */
.toast-wrap{position:fixed;bottom:1.5rem;right:1.5rem;z-index:700;
  display:flex;flex-direction:column;gap:.6rem;}
.toast{background:var(--card);border:1px solid var(--border2);border-radius:var(--radius2);
  padding:.9rem 1.2rem;display:flex;align-items:center;gap:.75rem;min-width:260px;
  box-shadow:var(--shadow);animation:fadeUp .3s ease;border-left:3px solid var(--green);}
.toast-msg{font-size:.85rem}

/* ══════════ RESPONSIVE ══════════ */
@media(max-width:1024px){
  .hero::after,.hero-mesh{display:none}
  .banner{grid-template-columns:1fr;padding:3rem}
  .banner-visual{height:260px}
  .footer-grid{grid-template-columns:1fr 1fr}
  .stats{grid-template-columns:1fr 1fr}
  .detail-layout{grid-template-columns:1fr}
  .profile-layout{grid-template-columns:1fr}
  .profile-sidebar{position:static}
  .checkout-layout{grid-template-columns:1fr}
}
@media(max-width:768px){
  .nav-search{display:none}
  .hamburger{display:flex}
  .products-grid{grid-template-columns:repeat(auto-fill,minmax(200px,1fr))}
  .stats{grid-template-columns:1fr 1fr}
  .banner{padding:2rem}
  .footer-grid{grid-template-columns:1fr}
  .cart-drawer,.wish-drawer{width:100%}
  .newsletter{padding:3rem 5%}
  .info-grid,.form-row{grid-template-columns:1fr}
}
</style>
</head>
<body>

<!-- ══════════════════════════════════════
     OVERLAYS
══════════════════════════════════════ -->
<div class="overlay-bg" id="overlayBg" onclick="closeAllDrawers()"></div>

<!-- CART DRAWER -->
<aside class="cart-drawer" id="cartDrawer">
  <div class="drawer-head">
    <h3>Cart <span id="cartCountLabel" style="color:var(--gold);font-size:.9rem">(0)</span></h3>
    <button class="drawer-close" onclick="closeAllDrawers()">✕</button>
  </div>
  <div class="cart-empty-state" id="cartEmptyState">
    <div class="cart-empty-icon">🛍</div>
    <p>Your cart is empty.<br/>Add something beautiful.</p>
  </div>
  <div class="cart-items-list" id="cartItemsList" style="display:none"></div>
  <div class="cart-footer-panel" id="cartFooterPanel" style="display:none">
    <div class="cart-total-row"><span>Total</span><strong id="cartTotalAmt">$0</strong></div>
    <button class="btn btn-gold btn-full" onclick="closeAllDrawers();showPage('checkout')" style="margin-bottom:.75rem">Proceed to Checkout →</button>
    <button class="btn btn-ghost btn-full btn-sm" onclick="closeAllDrawers()">Continue Shopping</button>
  </div>
</aside>

<!-- WISHLIST DRAWER -->
<aside class="wish-drawer" id="wishDrawer">
  <div class="drawer-head">
    <h3>Wishlist <span id="wishCountLabel" style="color:var(--gold);font-size:.9rem">(0)</span></h3>
    <button class="drawer-close" onclick="closeAllDrawers()">✕</button>
  </div>
  <div class="cart-empty-state" id="wishEmptyState">
    <div class="cart-empty-icon">♡</div>
    <p>Your wishlist is empty.<br/>Save items you love.</p>
  </div>
  <div class="wish-items-list" id="wishItemsList" style="display:none"></div>
</aside>

<!-- ══════════════════════════════════════
     AUTH MODAL
══════════════════════════════════════ -->
<div class="modal-wrap" id="authModal">
  <div class="modal-box">
    <div class="modal-head">
      <h3 id="authModalTitle">Welcome to NOIR</h3>
      <button class="modal-close-btn" onclick="closeModal('authModal')">✕</button>
    </div>
    <div class="auth-tabs">
      <div class="auth-tab active" onclick="switchAuthTab('login')">Sign In</div>
      <div class="auth-tab" onclick="switchAuthTab('register')">Create Account</div>
    </div>

    <!-- LOGIN -->
    <div class="auth-panel active" id="loginPanel">
      <div class="form-group">
        <label class="form-label">Email Address</label>
        <input class="form-input" type="email" id="loginEmail" placeholder="you@email.com"/>
      </div>
      <div class="form-group">
        <label class="form-label" style="display:flex;justify-content:space-between">
          Password <span class="form-link" onclick="showToast('Password reset link sent!')">Forgot?</span>
        </label>
        <input class="form-input" type="password" id="loginPass" placeholder="••••••••"/>
      </div>
      <button class="btn btn-gold btn-full" style="margin-bottom:1rem" onclick="doLogin()">Sign In</button>
      <div class="form-divider">or continue with</div>
      <div style="display:flex;gap:.75rem;margin-top:.75rem">
        <button class="btn btn-ghost btn-full" onclick="doSocialLogin('Google')">🔵 Google</button>
        <button class="btn btn-ghost btn-full" onclick="doSocialLogin('Apple')">🍎 Apple</button>
      </div>
      <p class="auth-footer-text">No account? <span class="form-link" onclick="switchAuthTab('register')">Register free</span></p>
    </div>

    <!-- REGISTER -->
    <form method="POST" action="backend/add_user.php">
    <div class="auth-panel" id="registerPanel">
      <div class="form-row">
        <div class="form-group">
          <label class="form-label">Full Name</label>
          <input class="form-input" type="text" name="fullname" id="regFirst" placeholder="Jane"/>
        </div>
       
      </div>
      <div class="form-group">
        <label class="form-label">Email Address</label>
        <input class="form-input" type="email" id="regEmail" name="email" placeholder="you@email.com"/>
      </div>
      <div class="form-group">
        <label class="form-label">Password</label>
        <input class="form-input" type="password" id="regPass" name="password" placeholder="Min 6 characters"/>
      </div>
      <div class="form-group">
        <label class="form-label">Confirm Password</label>
        <input class="form-input" type="password" id="regConfirm" placeholder="Repeat password"/>
      </div>
      <button type="submit" class="btn btn-gold btn-full">Create Account</button>
      <p class="auth-footer-text">Already a member? <span class="form-link" onclick="switchAuthTab('login')">Sign in</span></p>
    </div>
    </form>
  </div>
</div>

<!-- PRODUCT QUICK VIEW MODAL -->
<div class="modal-wrap" id="quickViewModal">
  <div class="modal-box" style="max-width:600px">
    <div class="modal-head">
      <h3 id="qvName">Product Name</h3>
      <button class="modal-close-btn" onclick="closeModal('quickViewModal')">✕</button>
    </div>
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:1.5rem">
      <div style="height:220px;background:var(--bg3);border-radius:var(--radius2);overflow:hidden">
        <img id="qvImg" src="" alt="" style="width:100%;height:100%;object-fit:cover"/>
      </div>
      <div>
        <div class="product-cat" id="qvCat"></div>
        <div class="stars-row" style="margin-bottom:.5rem">★★★★★</div>
        <div style="font-size:1.4rem;font-weight:700;color:var(--gold);margin-bottom:.75rem" id="qvPrice"></div>
        <p style="font-size:.85rem;color:var(--gray);line-height:1.7;margin-bottom:1.2rem" id="qvDesc"></p>
        <button class="btn btn-gold btn-full" id="qvAddBtn">Add to Cart</button>
        <button class="btn btn-ghost btn-full btn-sm" style="margin-top:.6rem" id="qvViewBtn">View Full Details →</button>
      </div>
    </div>
  </div>
</div>

<!-- ORDER SUCCESS MODAL -->
<div class="modal-wrap" id="orderModal">
  <div class="modal-box" style="text-align:center">
    <div style="font-size:4rem;margin-bottom:1rem">🎉</div>
    <h3 style="font-family:'Cormorant Garamond',serif;font-size:1.8rem;margin-bottom:.75rem">Order Placed!</h3>
    <p style="color:var(--gray);margin-bottom:2rem">Your order is confirmed and will arrive in 3–5 business days. A confirmation has been sent to your email.</p>
    <div style="background:var(--bg3);border-radius:10px;padding:1rem;margin-bottom:1.5rem">
      <div style="color:var(--gray);font-size:.75rem;text-transform:uppercase;letter-spacing:.1em">Order Reference</div>
      <div style="color:var(--gold);font-size:1.2rem;font-weight:700" id="orderIdDisplay">#NOIR-0000</div>
    </div>
    <button class="btn btn-gold btn-full" onclick="closeModal('orderModal');showPage('home')">Continue Shopping</button>
    <button class="btn btn-ghost btn-full btn-sm" style="margin-top:.6rem" onclick="closeModal('orderModal');showPage('profile')">View Order History</button>
  </div>
</div>

<!-- ══════════════════════════════════════
     MOBILE NAV
══════════════════════════════════════ -->
<nav class="mobile-nav" id="mobileNav">
  <button class="mnav-close" onclick="closeMobileNav()">✕</button>
  <a onclick="closeMobileNav();showPage('home')">Home</a>
  <a onclick="closeMobileNav();document.getElementById('featured').scrollIntoView({behavior:'smooth'})">Shop</a>
  <a onclick="closeMobileNav();showPage('profile')">My Account</a>
  <a onclick="closeMobileNav();showPage('checkout')">Checkout</a>
</nav>

<!-- ══════════════════════════════════════
     NAVBAR
══════════════════════════════════════ -->
<nav class="navbar">
  <div class="nav-logo" onclick="showPage('home')">NOIR<span>.</span></div>
  <div class="nav-search">
    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
      <circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/>
    </svg>
    <input type="text" id="searchInput" placeholder="Search products…" oninput="filterProducts(this.value)" autocomplete="off"/>
  </div>
  <div class="nav-right">
    <button class="nav-icon" title="Wishlist" onclick="openWishlist()">
      ♡<span class="nav-badge" id="wishBadge" style="display:none">0</span>
    </button>
    <button class="nav-icon" title="Account" onclick="handleAccountClick()">
      <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>
      </svg>
    </button>
    <button class="nav-icon" title="Cart" onclick="openCart()">
      🛒<span class="nav-badge" id="cartBadge">0</span>
    </button>
    <button class="hamburger" onclick="openMobileNav()">
      <span></span><span></span><span></span>
    </button>
  </div>
</nav>

<!-- ══════════════════════════════════════
     HOME PAGE
══════════════════════════════════════ -->
<div class="page active" id="page-home">

  <!-- Hero -->
  <section class="hero">
    <div class="hero-content">
      <div class="hero-eyebrow">New Arrivals — Spring 2025</div>
      <h1>Crafted for<br/>the <em>Discerning</em><br/>Collector</h1>
      <p class="hero-sub">Curated luxury goods, handpicked by experts. Each piece tells a story of artistry and timeless design.</p>
      <div class="hero-btns">
        <button class="btn btn-gold" onclick="document.getElementById('featured').scrollIntoView({behavior:'smooth'})">Explore Collection</button>
        <button class="btn btn-ghost" onclick="document.getElementById('categories').scrollIntoView({behavior:'smooth'})">Browse Categories</button>
      </div>
    </div>
    <div class="hero-mesh">
      <div class="hero-mesh-card">
        <img src="https://picsum.photos/seed/watch/300/240" alt="Watch"/>
        <div class="hero-mesh-card-body"><p>Gold Timepiece</p><span>$1,299</span></div>
      </div>
      <div class="hero-mesh-card">
        <img src="https://picsum.photos/seed/ring/300/240" alt="Ring"/>
        <div class="hero-mesh-card-body"><p>Diamond Ring</p><span>$2,499</span></div>
      </div>
      <div class="hero-mesh-card">
        <img src="https://picsum.photos/seed/bag/300/240" alt="Bag"/>
        <div class="hero-mesh-card-body"><p>Leather Tote</p><span>$459</span></div>
      </div>
      <div class="hero-mesh-card">
        <img src="https://picsum.photos/seed/sunglass/300/240" alt="Sunglasses"/>
        <div class="hero-mesh-card-body"><p>Carbon Frames</p><span>$289</span></div>
      </div>
    </div>
  </section>

  <!-- Marquee -->
  <div class="marquee-bar" aria-hidden="true">
    <div class="marquee-track">
      <span class="marquee-item">Free Worldwide Shipping</span>
      <span class="marquee-item">Authenticated Products</span>
      <span class="marquee-item">30-Day Returns</span>
      <span class="marquee-item">24/7 Concierge</span>
      <span class="marquee-item">Limited Editions</span>
      <span class="marquee-item">Free Worldwide Shipping</span>
      <span class="marquee-item">Authenticated Products</span>
      <span class="marquee-item">30-Day Returns</span>
      <span class="marquee-item">24/7 Concierge</span>
      <span class="marquee-item">Limited Editions</span>
    </div>
  </div>

  <!-- Categories -->
  <section class="section" id="categories">
    <div class="section-header">
      <div class="section-eyebrow">Explore</div>
      <h2 class="section-title">Shop by Category</h2>
    </div>
    <div class="categories-grid">
      <div class="category-card" onclick="filterByCategory('Watches')"><div class="cat-icon">⌚</div><div class="cat-name">Watches</div><div class="cat-count">24 pieces</div></div>
      <div class="category-card" onclick="filterByCategory('Jewelry')"><div class="cat-icon">💎</div><div class="cat-name">Jewelry</div><div class="cat-count">38 pieces</div></div>
      <div class="category-card" onclick="filterByCategory('Bags')"><div class="cat-icon">👜</div><div class="cat-name">Bags</div><div class="cat-count">19 pieces</div></div>
      <div class="category-card" onclick="filterByCategory('Fashion')"><div class="cat-icon">🧥</div><div class="cat-name">Fashion</div><div class="cat-count">52 pieces</div></div>
      <div class="category-card" onclick="filterByCategory('Electronics')"><div class="cat-icon">📱</div><div class="cat-name">Electronics</div><div class="cat-count">31 pieces</div></div>
      <div class="category-card" onclick="filterByCategory('Beauty')"><div class="cat-icon">✨</div><div class="cat-name">Beauty</div><div class="cat-count">44 pieces</div></div>
      <div class="category-card" onclick="filterByCategory('Home')"><div class="cat-icon">🏺</div><div class="cat-name">Home</div><div class="cat-count">27 pieces</div></div>
      <div class="category-card" onclick="clearFilter()"><div class="cat-icon">◎</div><div class="cat-name">View All</div><div class="cat-count">235 pieces</div></div>
    </div>
  </section>

  <!-- Featured Products -->
  <section class="section" id="featured" style="background:var(--bg2)">
    <div class="section-header" style="display:flex;align-items:flex-end;justify-content:space-between;flex-wrap:wrap;gap:1rem">
      <div>
        <div class="section-eyebrow">Curated</div>
        <h2 class="section-title">Featured Products</h2>
      </div>
      <button class="btn btn-ghost btn-sm" onclick="clearFilter()">View All →</button>
    </div>
    <div class="products-grid" id="productsGrid">

       <?php while($row = mysqli_fetch_assoc($result)): 
          $id    = $row['id'];
          $name  = htmlspecialchars($row['product_name']);
          $cat   = htmlspecialchars($row['category']);
          $price = (float)$row['price'];
          $old   = (!empty($row['old_price']) && $row['old_price'] > 0) ? (float)$row['old_price'] : null;
          $desc  = htmlspecialchars($row['description'] ?? '');
      
         // NEW - correct path
          $filename = basename(str_replace('\\', '/', $row['image']));
          $img = 'http://localhost/Ecommerse/backend/uploads/' . $filename;
      ?>
      
      <article class="product-card"
        data-id="<?= $id ?>"
        data-name="<?= $name ?>"
        data-category="<?= $cat ?>"
        data-price="<?= $price ?>"
        data-img="<?= $img ?>"
        data-desc="<?= $desc ?>">
      
        <?php if($old): ?>
          <span class="product-badge badge-sale">Sale</span>
        <?php else: ?>
          <span class="product-badge badge-new">New</span>
        <?php endif; ?>
      
        <div class="product-img">
          <img src="<?= $img ?>" alt="<?= $name ?>" loading="lazy"
               onerror="this.src='https://picsum.photos/seed/product/500/400'"/>
          <div class="product-overlay">
            <button class="overlay-btn" onclick="quickView(this.closest('.product-card'))">Quick View</button>
            <button class="overlay-btn" onclick="addToCartFromCard(this.closest('.product-card'))">Add to Cart</button>
          </div>
        </div>
      
        <div class="product-body">
          <div class="product-cat"><?= $cat ?></div>
          <div class="product-name"><?= $name ?></div>
          <div class="product-stars">
            <span class="stars-row">★★★★★</span>
            <span class="stars-count">(0)</span>
          </div>
          <div class="product-price-row">
            <div class="product-price">
              <span class="price-now">$<?= number_format($price, 2) ?></span>
              <?php if($old): ?>
                <span class="price-was">$<?= number_format($old, 2) ?></span>
              <?php endif; ?>
            </div>
            <button class="add-btn" onclick="addToCartFromCard(this.closest('.product-card'))">+</button>
          </div>
        </div>
      </article>
      
      <?php endwhile; ?>
      
      <div class="no-results" id="noResults" style="display:none">No products match your search.</div>

      
      
    </div>
  </section>

  <!-- Banner -->
  <section>
    <div class="banner">
      <div>
        <div class="banner-eyebrow">Limited Collection</div>
        <h2>Up to 40% Off<br/>The Luxury Edit</h2>
        <p>A rare opportunity to own pieces from our most coveted archive. Each item is authenticated, numbered, and arrives in our signature black box.</p>
        <div class="banner-perks">
          <div class="banner-perk">Complimentary worldwide express shipping</div>
          <div class="banner-perk">Lifetime authenticity guarantee</div>
          <div class="banner-perk">White-glove packaging & gifting</div>
          <div class="banner-perk">Personal styling consultation</div>
        </div>
        <button class="btn btn-gold" onclick="document.getElementById('featured').scrollIntoView({behavior:'smooth'})">Shop the Edit</button>
      </div>
      <div class="banner-visual">
        <img src="https://picsum.photos/seed/luxury/700/500" alt="Luxury"/>
        <div class="banner-visual-overlay">
          <span class="banner-visual-tag">Up to 40% off</span>
          <div class="banner-visual-title">The Spring Archive</div>
        </div>
      </div>
    </div>
  </section>

  <!-- Stats -->
  <div class="stats">
    <div><div class="stat-value">50K+</div><div class="stat-label">Happy Clients</div></div>
    <div><div class="stat-value">235+</div><div class="stat-label">Curated Products</div></div>
    <div><div class="stat-value">120+</div><div class="stat-label">Global Brands</div></div>
    <div><div class="stat-value">4.9★</div><div class="stat-label">Average Rating</div></div>
  </div>

  <!-- Newsletter -->
  <section class="newsletter" id="newsletter">
    <p class="section-eyebrow" style="justify-content:center">Stay in the loop</p>
    <h2>Join the Inner Circle</h2>
    <p>Early access to new arrivals, exclusive offers, and curated edits delivered to your inbox.</p>
    <form class="newsletter-form" onsubmit="subscribeNewsletter(event)">
      <input type="email" placeholder="Your email address" required/>
      <button type="submit">Subscribe</button>
    </form>
  </section>

  <!-- Footer -->
  <footer>
    <div class="footer-grid">
      <div class="footer-brand">
        <div class="footer-logo">NOIR.</div>
        <p>A curated destination for luxury goods and exceptional craftsmanship. We believe in the beauty of things made to last.</p>
        <div class="social-row">
          <a class="social-btn" href="#">📷</a>
          <a class="social-btn" href="#">𝕏</a>
          <a class="social-btn" href="#">P</a>
          <a class="social-btn" href="#">▶</a>
        </div>
      </div>
      <div class="footer-col"><h5>Shop</h5><ul>
        <li><a onclick="clearFilter()">All Products</a></li>
        <li><a onclick="filterByCategory('Watches')">Watches</a></li>
        <li><a onclick="filterByCategory('Jewelry')">Jewelry</a></li>
        <li><a>Gift Cards</a></li>
      </ul></div>
      <div class="footer-col"><h5>Account</h5><ul>
        <li><a onclick="handleAccountClick()">Sign In</a></li>
        <li><a onclick="showPage('profile')">My Profile</a></li>
        <li><a onclick="showPage('profile');switchProfileTab('orders')">Order History</a></li>
        <li><a onclick="openWishlist()">Wishlist</a></li>
      </ul></div>
      <div class="footer-col"><h5>Support</h5><ul>
        <li><a>FAQ</a></li>
        <li><a>Shipping & Returns</a></li>
        <li><a>Track Order</a></li>
        <li><a>Contact Us</a></li>
      </ul></div>
    </div>
    <div class="footer-bottom">
      <p>© 2025 NOIR. All rights reserved.</p>
      <p style="color:var(--gray);font-size:.78rem">Privacy · Terms · Cookies</p>
    </div>
  </footer>
</div>

<!-- ══════════════════════════════════════
     PRODUCT DETAIL PAGE
══════════════════════════════════════ -->
<div class="page" id="page-detail">
  <div class="page-hero" style="padding:2rem 5%">
    <div class="breadcrumb">
      <span onclick="showPage('home')">Home</span>
      <span class="breadcrumb-sep">›</span>
      <span onclick="showPage('home')">Shop</span>
      <span class="breadcrumb-sep">›</span>
      <span id="detailBreadcrumb" style="color:var(--white)">Product</span>
    </div>
  </div>
  <div class="detail-layout">
    <div class="detail-gallery">
      <div class="main-img"><img id="detailMainImg" src="" alt=""/></div>
      <div class="thumbs-row" id="detailThumbs"></div>
    </div>
    <div class="detail-info">
      <div class="detail-cat" id="detailCat"></div>
      <h1 class="detail-name" id="detailName"></h1>
      <div class="detail-rating">
        <span class="stars-row">★★★★★</span>
        <span class="stars-count" id="detailReviews">(0 reviews)</span>
        <span style="color:var(--green);font-size:.8rem">● In Stock</span>
      </div>
      <div class="detail-price">
        <span class="detail-price-now" id="detailPriceNow"></span>
        <span class="detail-price-was" id="detailPriceWas"></span>
      </div>
      <p class="detail-desc" id="detailDesc"></p>
      <span class="option-label">Color</span>
      <div class="color-row">
        <div class="color-dot active" style="background:#c8a97e" onclick="selectColor(this)"></div>
        <div class="color-dot" style="background:#888" onclick="selectColor(this)"></div>
        <div class="color-dot" style="background:#222" onclick="selectColor(this)"></div>
        <div class="color-dot" style="background:#8B4513" onclick="selectColor(this)"></div>
      </div>
      <span class="option-label">Size</span>
      <div class="size-row">
        <button class="size-btn active" onclick="selectSize(this)">XS</button>
        <button class="size-btn" onclick="selectSize(this)">S</button>
        <button class="size-btn" onclick="selectSize(this)">M</button>
        <button class="size-btn" onclick="selectSize(this)">L</button>
        <button class="size-btn" onclick="selectSize(this)">XL</button>
      </div>
      <div class="qty-row">
        <div class="qty-ctrl">
          <button class="qty-btn" onclick="changeQty(-1)">−</button>
          <input class="qty-val" id="detailQty" value="1" readonly/>
          <button class="qty-btn" onclick="changeQty(1)">+</button>
        </div>
        <span style="font-size:.82rem;color:var(--gray)">Max 10 per order</span>
      </div>
      <div class="detail-action-row">
        <button class="btn btn-gold" style="flex:2" id="detailAddBtn">🛒 Add to Cart</button>
        <button class="wishlist-btn" onclick="addToWishlistFromDetail()" title="Add to Wishlist">♡</button>
      </div>
      <div class="detail-features">
        <div class="detail-feature"><span class="detail-feature-icon">🚚</span> Free worldwide shipping</div>
        <div class="detail-feature"><span class="detail-feature-icon">↩️</span> 30-day returns</div>
        <div class="detail-feature"><span class="detail-feature-icon">✅</span> Authenticity guaranteed</div>
        <div class="detail-feature"><span class="detail-feature-icon">🎁</span> Luxury gift packaging</div>
      </div>
    </div>
  </div>
  <div class="reviews-section">
    <div class="section-eyebrow">Reviews</div>
    <h2 class="section-title" style="font-size:1.6rem;margin-bottom:1.5rem">Customer Reviews</h2>
    <div class="review-card">
      <div class="review-head"><div><div class="reviewer-name">Alexandra M.</div><div class="stars-row" style="font-size:.8rem">★★★★★</div></div><div class="review-date">Feb 28, 2025</div></div>
      <p class="review-text">Absolutely stunning quality. The packaging alone was impressive, and the product exceeded every expectation. Will definitely purchase again.</p>
    </div>
    <div class="review-card">
      <div class="review-head"><div><div class="reviewer-name">James T.</div><div class="stars-row" style="font-size:.8rem">★★★★☆</div></div><div class="review-date">Feb 20, 2025</div></div>
      <p class="review-text">Great product, fast shipping. Exactly as described. The craftsmanship is exceptional for the price point. Highly recommend.</p>
    </div>
    <div class="review-card">
      <div class="review-head"><div><div class="reviewer-name">Sofia R.</div><div class="stars-row" style="font-size:.8rem">★★★★★</div></div><div class="review-date">Feb 15, 2025</div></div>
      <p class="review-text">Bought this as a gift and the recipient was overjoyed. Beautiful, high-quality, and arrived perfectly packaged in the NOIR signature box.</p>
    </div>
  </div>
</div>

<!-- ══════════════════════════════════════
     PROFILE PAGE
══════════════════════════════════════ -->
<div class="page" id="page-profile">
  <div class="page-hero">
    <div class="breadcrumb"><span onclick="showPage('home')">Home</span><span class="breadcrumb-sep">›</span><span style="color:var(--white)">My Account</span></div>
    <h1 style="font-family:'Cormorant Garamond',serif;font-size:2.5rem;font-weight:300;margin-top:.5rem">My Account</h1>
  </div>
  <div class="profile-layout">
    <aside class="profile-sidebar">
      <div class="profile-card">
        <div class="profile-avatar" id="profileAvatar">👤</div>
        <div class="profile-name" id="profileName">Guest User</div>
        <div class="profile-email" id="profileEmail">Not signed in</div>
      </div>
      <nav class="profile-nav">
        <div class="profile-nav-item active" onclick="switchProfileTab('overview')"><span class="profile-nav-icon">📊</span> Overview</div>
        <div class="profile-nav-item" onclick="switchProfileTab('orders')"><span class="profile-nav-icon">📦</span> Order History</div>
        <div class="profile-nav-item" onclick="switchProfileTab('wishlist-p')"><span class="profile-nav-icon">♡</span> Wishlist</div>
        <div class="profile-nav-item" onclick="switchProfileTab('addresses')"><span class="profile-nav-icon">📍</span> Addresses</div>
        <div class="profile-nav-item" onclick="switchProfileTab('settings')"><span class="profile-nav-icon">⚙️</span> Settings</div>
        <div class="profile-nav-item" onclick="doLogout()"><span class="profile-nav-icon">🚪</span> Sign Out</div>
      </nav>
    </aside>
    <div class="profile-content">

      <!-- OVERVIEW -->
      <div class="profile-panel active" id="panel-overview">
        <h2 class="profile-panel-title">Welcome back</h2>
        <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:1rem;margin-bottom:2rem">
          <div style="background:var(--card);border:1px solid var(--border);border-radius:var(--radius2);padding:1.5rem;text-align:center">
            <div style="font-family:'Cormorant Garamond',serif;font-size:2rem;color:var(--gold)">3</div>
            <div style="font-size:.72rem;letter-spacing:.1em;text-transform:uppercase;color:var(--gray)">Orders</div>
          </div>
          <div style="background:var(--card);border:1px solid var(--border);border-radius:var(--radius2);padding:1.5rem;text-align:center">
            <div style="font-family:'Cormorant Garamond',serif;font-size:2rem;color:var(--gold)" id="wishCountProfile">0</div>
            <div style="font-size:.72rem;letter-spacing:.1em;text-transform:uppercase;color:var(--gray)">Wishlist</div>
          </div>
          <div style="background:var(--card);border:1px solid var(--border);border-radius:var(--radius2);padding:1.5rem;text-align:center">
            <div style="font-family:'Cormorant Garamond',serif;font-size:2rem;color:var(--gold)">$2,147</div>
            <div style="font-size:.72rem;letter-spacing:.1em;text-transform:uppercase;color:var(--gray)">Total Spent</div>
          </div>
        </div>
        <h3 style="font-size:.8rem;letter-spacing:.15em;text-transform:uppercase;color:var(--gray);margin-bottom:1rem">Recent Orders</h3>
        <div class="order-row"><div><div class="order-id">#NOIR-7821</div><div class="order-name">Luminara Gold Watch</div><div class="order-date">Mar 15, 2025</div></div><span class="order-status status-delivered" style="margin-left:auto;margin-right:1rem">Delivered</span><div class="order-total">$1,299</div></div>
        <div class="order-row"><div><div class="order-id">#NOIR-7654</div><div class="order-name">Rose Gold Necklace</div><div class="order-date">Feb 28, 2025</div></div><span class="order-status status-shipped" style="margin-left:auto;margin-right:1rem">Shipped</span><div class="order-total">$799</div></div>
      </div>

      <!-- ORDERS -->
      <div class="profile-panel" id="panel-orders">
        <h2 class="profile-panel-title">Order History</h2>
        <div class="order-row"><div><div class="order-id">#NOIR-7821</div><div class="order-name">Luminara Gold Watch × 1</div><div class="order-date">Mar 15, 2025</div></div><span class="order-status status-delivered" style="margin-left:auto;margin-right:1rem">Delivered</span><div class="order-total">$1,299</div></div>
        <div class="order-row"><div><div class="order-id">#NOIR-7654</div><div class="order-name">Rose Gold Necklace × 1</div><div class="order-date">Feb 28, 2025</div></div><span class="order-status status-shipped" style="margin-left:auto;margin-right:1rem">Shipped</span><div class="order-total">$799</div></div>
        <div class="order-row"><div><div class="order-id">#NOIR-7201</div><div class="order-name">Vitamin C Serum Gold × 2</div><div class="order-date">Jan 10, 2025</div></div><span class="order-status status-processing" style="margin-left:auto;margin-right:1rem">Processing</span><div class="order-total">$178</div></div>
      </div>

      <!-- WISHLIST IN PROFILE -->
      <div class="profile-panel" id="panel-wishlist-p">
        <h2 class="profile-panel-title">My Wishlist</h2>
        <div id="profileWishlistContent" style="color:var(--gray);font-size:.9rem">Your wishlist is empty. Browse products and click ♡ to save items.</div>
      </div>

      <!-- ADDRESSES -->
      <div class="profile-panel" id="panel-addresses">
        <h2 class="profile-panel-title">Saved Addresses</h2>
        <div class="addr-card">
          <div class="addr-label">🏠 Home — Default</div>
          <div class="addr-text">Jane Doe<br/>42 Mayfair Lane, Apartment 3B<br/>London, W1K 4PL<br/>United Kingdom</div>
          <div class="addr-actions">
            <button class="addr-btn">Edit</button>
            <button class="addr-btn">Delete</button>
          </div>
        </div>
        <div class="addr-card">
          <div class="addr-label">🏢 Work</div>
          <div class="addr-text">Jane Doe<br/>15 Canary Wharf, Floor 12<br/>London, E14 5AB<br/>United Kingdom</div>
          <div class="addr-actions">
            <button class="addr-btn">Edit</button>
            <button class="addr-btn">Delete</button>
          </div>
        </div>
        <button class="btn btn-ghost btn-sm" style="margin-top:.75rem" onclick="showToast('Add address coming soon!')">+ Add New Address</button>
      </div>

      <!-- SETTINGS -->
      <div class="profile-panel" id="panel-settings">
        <h2 class="profile-panel-title">Account Settings</h2>
        <div class="info-grid">
          <div class="form-group"><label class="form-label">First Name</label><input class="form-input" type="text" id="settingFirst" value="Jane"/></div>
          <div class="form-group"><label class="form-label">Last Name</label><input class="form-input" type="text" id="settingLast" value="Doe"/></div>
          <div class="form-group"><label class="form-label">Email</label><input class="form-input" type="email" id="settingEmail" value="jane.doe@email.com"/></div>
          <div class="form-group"><label class="form-label">Phone</label><input class="form-input" type="tel" id="settingPhone" value="+44 7911 123456"/></div>
        </div>
        <div class="form-group" style="margin-bottom:1.5rem">
          <label class="form-label">Current Password</label>
          <input class="form-input" type="password" placeholder="Enter current password"/>
        </div>
        <div class="form-row" style="margin-bottom:2rem">
          <div class="form-group"><label class="form-label">New Password</label><input class="form-input" type="password" placeholder="New password"/></div>
          <div class="form-group"><label class="form-label">Confirm Password</label><input class="form-input" type="password" placeholder="Confirm new password"/></div>
        </div>
        <button class="btn btn-gold" onclick="showToast('Settings saved successfully!')">Save Changes</button>
      </div>

    </div>
  </div>
</div>

<!-- ══════════════════════════════════════
     CHECKOUT PAGE
══════════════════════════════════════ -->
<div class="page" id="page-checkout">
  <div class="page-hero">
    <div class="breadcrumb">
      <span onclick="showPage('home')">Home</span><span class="breadcrumb-sep">›</span>
      <span onclick="openCart()">Cart</span><span class="breadcrumb-sep">›</span>
      <span style="color:var(--white)">Checkout</span>
    </div>
    <h1 style="font-family:'Cormorant Garamond',serif;font-size:2.5rem;font-weight:300;margin-top:.5rem">Checkout</h1>
  </div>
  <div class="checkout-layout">
    <div>
      <!-- Contact -->
      <form method="POST" action="backend/order_detail.php" onsubmit="injectCartItems()">
        <input type="hidden" name="cart_items" id="cartItemsInput"/>
        <input type="hidden" name="cart_amount" id="cartAmountInput"/>
      <div class="checkout-box">
        <div class="checkout-box-title">Contact Information</div>
        
        <div class="form-row">
          <div class="form-group"><label class="form-label">First Name *</label><input class="form-input" id="coFirst" name="first_name" placeholder="Jane"/></div>
          <div class="form-group"><label class="form-label">Last Name *</label><input class="form-input" id="coLast" name="last_name" placeholder="Doe"/></div>
        </div>
        <div class="form-row">
          <div class="form-group"><label class="form-label">Email *</label><input class="form-input" id="coEmail" name="email" type="email" placeholder="jane@email.com"/></div>
          <div class="form-group"><label class="form-label">Phone *</label><input class="form-input" id="coPhone" name="phone" type="tel" placeholder="+44 7911 000000"/></div>
        </div>
      </div>
      <!-- Shipping -->
      <div class="checkout-box">
        <div class="checkout-box-title">Shipping Address</div>
        <div class="form-group"><label class="form-label">Street Address *</label><input class="form-input" id="coAddr" name="street_address" placeholder="42 Mayfair Lane"/></div>
        <div class="form-row">
          <div class="form-group"><label class="form-label">City *</label><input class="form-input" id="coCity" name="city" placeholder="London"/></div>
          <div class="form-group"><label class="form-label">ZIP / Postcode *</label><input class="form-input" id="coZip" name="zip" placeholder="W1K 4PL"/></div>
        </div>
        <div class="form-group"><label class="form-label">Country</label>
          <select class="form-input" name="country" id="coCountry">
            <option>United Kingdom</option><option>United States</option>
            <option>Canada</option><option>Australia</option>
            <option>Germany</option><option>France</option>
            <option>Nepal</option><option>Japan</option><option>China</option>
          </select>
        </div>
        <div class="form-group"><label class="form-label">Delivery Notes (Optional)</label>
          <input class="form-input" id="coNotes" placeholder="Ring bell twice, leave at door…"/>
        </div>
      </div>
      <!-- Payment -->
      <div class="checkout-box">
        <div class="checkout-box-title">Payment Method</div>
        <div class="payment-opts">
          <div class="payment-opt selected" onclick="selectPayment(this)"><input type="radio" name="pay" checked/> 💳 Credit / Debit Card</div>
          <div class="payment-opt" onclick="selectPayment(this)"><input type="radio" name="pay"/> 📱 PayPal</div>
          <div class="payment-opt" onclick="selectPayment(this)"><input type="radio" name="pay"/> 🏦 Bank Transfer</div>
          <div class="payment-opt" onclick="selectPayment(this)"><input type="radio" name="pay"/> 💵 Cash on Delivery</div>
        </div>
      </div>
      <button type="submit" class="btn btn-gold btn-full" style="padding:1rem" >🔒 Place Order Securely</button>
      </form>  
    </div>

    <!-- Summary -->
    <div>
      <div class="checkout-summary">
        <div class="checkout-summary-title">Order Summary</div>
        <div id="checkoutItems"><p style="color:var(--gray);font-size:.85rem">No items in cart.</p></div>
        <div id="checkoutTotals"></div>
      </div>
    </div>
  </div>
</div>

<div class="toast-wrap" id="toastWrap"></div>

<!-- ══════════════════════════════════════
     JAVASCRIPT
══════════════════════════════════════ -->
<script>
/* ── STATE ── */
var cartItems = [];
var cartTotal = 0;
var wishItems = [];
var currentUser = null;
var currentDetailProduct = null;

/* ══════════════════════════════════════
   PAGE NAVIGATION
══════════════════════════════════════ */
function showPage(id) {
  document.querySelectorAll('.page').forEach(function(p){ p.classList.remove('active'); });
  var pg = document.getElementById('page-' + id);
  if (pg) { pg.classList.add('active'); window.scrollTo({top:0,behavior:'smooth'}); }
  if (id === 'checkout') renderCheckoutSummary();
  if (id === 'profile') renderProfileWishlist();
}

/* ══════════════════════════════════════
   MOBILE NAV
══════════════════════════════════════ */
function openMobileNav()  { document.getElementById('mobileNav').classList.add('open'); }
function closeMobileNav() { document.getElementById('mobileNav').classList.remove('open'); }

/* ══════════════════════════════════════
   DRAWERS
══════════════════════════════════════ */
function openCart() {
  document.getElementById('cartDrawer').classList.add('open');
  document.getElementById('overlayBg').classList.add('open');
}
function openWishlist() {
  document.getElementById('wishDrawer').classList.add('open');
  document.getElementById('overlayBg').classList.add('open');
}
function closeAllDrawers() {
  document.getElementById('cartDrawer').classList.remove('open');
  document.getElementById('wishDrawer').classList.remove('open');
  document.getElementById('overlayBg').classList.remove('open');
}

/* ══════════════════════════════════════
   MODALS
══════════════════════════════════════ */
function openModal(id)  { document.getElementById(id).classList.add('open'); }
function closeModal(id) { document.getElementById(id).classList.remove('open'); }
document.querySelectorAll('.modal-wrap').forEach(function(m){
  m.addEventListener('click', function(e){ if(e.target===this) this.classList.remove('open'); });
});

/* ══════════════════════════════════════
   AUTH
══════════════════════════════════════ */
function handleAccountClick() {
  if (currentUser) { showPage('profile'); }
  else { openModal('authModal'); }
}

function switchAuthTab(tab) {
  document.querySelectorAll('.auth-tab').forEach(function(t,i){
    t.classList.toggle('active', (i===0&&tab==='login')||(i===1&&tab==='register'));
  });
  document.getElementById('loginPanel').classList.toggle('active', tab==='login');
  document.getElementById('registerPanel').classList.toggle('active', tab==='register');
}

function doLogin() {
  var email = document.getElementById('loginEmail').value.trim();
  var pass  = document.getElementById('loginPass').value;
  if (!email || !pass) { showToast('Please fill in all fields', 'error'); return; }
  if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) { showToast('Enter a valid email', 'error'); return; }
  if (pass.length < 6) { showToast('Password must be at least 6 characters', 'error'); return; }
  currentUser = { name: email.split('@')[0], email: email };
  updateProfileUI();
  closeModal('authModal');
  showToast('Welcome back, ' + currentUser.name + '!');
}

function doRegister() {
  var first   = document.getElementById('regFirst').value.trim();
  var last    = document.getElementById('regLast').value.trim();
  var email   = document.getElementById('regEmail').value.trim();
  var pass    = document.getElementById('regPass').value;
  var confirm = document.getElementById('regConfirm').value;
  if (!first||!last||!email||!pass) { showToast('Please fill in all fields', 'error'); return; }
  if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) { showToast('Enter a valid email', 'error'); return; }
  if (pass.length < 6) { showToast('Password must be at least 6 characters', 'error'); return; }
  if (pass !== confirm) { showToast('Passwords do not match', 'error'); return; }
  currentUser = { name: first + ' ' + last, email: email };
  updateProfileUI();
  closeModal('authModal');
  showToast('Account created! Welcome, ' + first + '!');
}

function doSocialLogin(provider) {
  currentUser = { name: provider + ' User', email: 'user@' + provider.toLowerCase() + '.com' };
  updateProfileUI();
  closeModal('authModal');
  showToast('Signed in with ' + provider + '!');
}

function doLogout() {
  currentUser = null;
  updateProfileUI();
  showPage('home');
  showToast('Signed out successfully');
}

function updateProfileUI() {
  var name  = currentUser ? currentUser.name  : 'Guest User';
  var email = currentUser ? currentUser.email : 'Not signed in';
  var init  = currentUser ? currentUser.name[0].toUpperCase() : '👤';
  document.getElementById('profileName').textContent  = name;
  document.getElementById('profileEmail').textContent = email;
  document.getElementById('profileAvatar').textContent = init;
  if (currentUser) {
    document.getElementById('settingFirst').value = name.split(' ')[0] || '';
    document.getElementById('settingLast').value  = name.split(' ')[1] || '';
    document.getElementById('settingEmail').value = email;
  }
}

/* ══════════════════════════════════════
   PROFILE TABS
══════════════════════════════════════ */
function switchProfileTab(tab) {
  document.querySelectorAll('.profile-nav-item').forEach(function(i){ i.classList.remove('active'); });
  document.querySelectorAll('.profile-panel').forEach(function(p){ p.classList.remove('active'); });
  var nav = Array.from(document.querySelectorAll('.profile-nav-item'));
  var panelMap = { overview:0, orders:1, 'wishlist-p':2, addresses:3, settings:4 };
  if (panelMap[tab] !== undefined) nav[panelMap[tab]].classList.add('active');
  var panel = document.getElementById('panel-' + tab);
  if (panel) panel.classList.add('active');
  if (tab === 'wishlist-p') renderProfileWishlist();
}

/* ══════════════════════════════════════
   CART
══════════════════════════════════════ */
function addToCartFromCard(card) {
  var name  = card.dataset.name;
  var price = parseInt(card.dataset.price);
  var img   = card.dataset.img;
  addToCart(name, price, img);
}

function addToCart(name, price, img) {
  var existing = cartItems.find(function(i){ return i.name===name; });
  if (existing) { existing.qty++; }
  else { cartItems.push({name:name,price:price,img:img,qty:1}); }
  cartTotal += price;
  updateCartUI();
  showToast('✓ ' + name + ' added to cart');
  openCart();
}

function removeFromCart(name, price) {
  var idx = cartItems.findIndex(function(i){ return i.name===name; });
  if (idx > -1) { cartTotal -= price * cartItems[idx].qty; cartItems.splice(idx,1); updateCartUI(); }
}

function updateCartUI() {
  var qty = cartItems.reduce(function(s,i){ return s+i.qty; }, 0);
  document.getElementById('cartBadge').textContent = qty;
  document.getElementById('cartCountLabel').textContent = '(' + qty + ')';
  document.getElementById('cartTotalAmt').textContent = '$' + cartTotal.toLocaleString();
  var empty = cartItems.length === 0;
  document.getElementById('cartEmptyState').style.display  = empty ? 'flex' : 'none';
  document.getElementById('cartItemsList').style.display   = empty ? 'none' : 'block';
  document.getElementById('cartFooterPanel').style.display = empty ? 'none' : 'block';
  document.getElementById('cartItemsList').innerHTML = cartItems.map(function(item){
    return '<div class="cart-item">' +
      '<div class="cart-item-img"><img src="'+item.img+'" alt="'+item.name+'"/></div>' +
      '<div class="cart-item-info"><div class="cart-item-name">'+item.name+(item.qty>1?' ×'+item.qty:'')+'</div>' +
      '<div class="cart-item-price">$'+(item.price*item.qty).toLocaleString()+'</div></div>' +
      '<button class="cart-item-remove" onclick="removeFromCart(\''+item.name+'\','+item.price+')">✕</button>' +
    '</div>';
  }).join('');
}

/* ══════════════════════════════════════
   WISHLIST
══════════════════════════════════════ */
function addToWishlistFromCard(card) {
  var name  = card.dataset.name;
  var price = parseInt(card.dataset.price);
  var img   = card.dataset.img;
  addToWishlist(name, price, img);
}

function addToWishlist(name, price, img) {
  if (wishItems.find(function(i){ return i.name===name; })) {
    showToast(name + ' is already in your wishlist'); return;
  }
  wishItems.push({name:name,price:price,img:img});
  updateWishUI();
  showToast('♡ Added to wishlist: ' + name);
}

function removeFromWishlist(name) {
  wishItems = wishItems.filter(function(i){ return i.name!==name; });
  updateWishUI();
  renderProfileWishlist();
}

function moveWishToCart(name) {
  var item = wishItems.find(function(i){ return i.name===name; });
  if (item) { addToCart(item.name, item.price, item.img); removeFromWishlist(name); }
}

function updateWishUI() {
  var qty = wishItems.length;
  var badge = document.getElementById('wishBadge');
  badge.textContent = qty;
  badge.style.display = qty > 0 ? 'flex' : 'none';
  document.getElementById('wishCountLabel').textContent = '(' + qty + ')';
  var empty = wishItems.length === 0;
  document.getElementById('wishEmptyState').style.display = empty ? 'flex' : 'none';
  document.getElementById('wishItemsList').style.display  = empty ? 'none' : 'block';
  document.getElementById('wishCountProfile').textContent = qty;
  document.getElementById('wishItemsList').innerHTML = wishItems.map(function(item){
    return '<div class="wish-item">' +
      '<div class="wish-item-img"><img src="'+item.img+'" alt="'+item.name+'"/></div>' +
      '<div class="wish-item-info"><div class="wish-item-name">'+item.name+'</div>' +
      '<div class="wish-item-price">$'+item.price.toLocaleString()+'</div></div>' +
      '<div class="wish-item-actions">' +
      '<button class="wish-add-btn" onclick="moveWishToCart(\''+item.name+'\')">Add to Cart</button>' +
      '<button class="wish-remove-btn" onclick="removeFromWishlist(\''+item.name+'\')">✕ Remove</button>' +
      '</div></div>';
  }).join('');
}

function renderProfileWishlist() {
  var container = document.getElementById('profileWishlistContent');
  if (!container) return;
  if (wishItems.length === 0) {
    container.innerHTML = '<p style="color:var(--gray);font-size:.9rem">Your wishlist is empty. Browse products and click ♡ to save items.</p>';
    return;
  }
  container.innerHTML = wishItems.map(function(item){
    return '<div class="wish-item" style="background:var(--card);border:1px solid var(--border);border-radius:var(--radius2);padding:1rem;margin-bottom:.75rem">' +
      '<div class="wish-item-img"><img src="'+item.img+'" alt="'+item.name+'"/></div>' +
      '<div class="wish-item-info"><div class="wish-item-name">'+item.name+'</div>' +
      '<div class="wish-item-price">$'+item.price.toLocaleString()+'</div></div>' +
      '<div class="wish-item-actions">' +
      '<button class="wish-add-btn" onclick="moveWishToCart(\''+item.name+'\')">Add to Cart</button>' +
      '<button class="wish-remove-btn" onclick="removeFromWishlist(\''+item.name+'\');renderProfileWishlist()">✕</button>' +
      '</div></div>';
  }).join('');
}

/* ══════════════════════════════════════
   QUICK VIEW
══════════════════════════════════════ */
function quickView(card) {
  var name  = card.dataset.name;
  var cat   = card.dataset.category;
  var price = card.dataset.price;
  var img   = card.dataset.img;
  var desc  = card.dataset.desc;
  document.getElementById('qvName').textContent = name;
  document.getElementById('qvCat').textContent  = cat;
  document.getElementById('qvPrice').textContent = '$' + parseInt(price).toLocaleString();
  document.getElementById('qvImg').src           = img;
  document.getElementById('qvDesc').textContent  = desc;
  document.getElementById('qvAddBtn').onclick = function(){ addToCart(name,parseInt(price),img); closeModal('quickViewModal'); };
  document.getElementById('qvViewBtn').onclick = function(){ closeModal('quickViewModal'); openDetailPage(card); };
  openModal('quickViewModal');
}

/* ══════════════════════════════════════
   PRODUCT DETAIL PAGE
══════════════════════════════════════ */
function openDetailPage(card) {
  currentDetailProduct = {
    name: card.dataset.name, cat: card.dataset.category,
    price: parseInt(card.dataset.price), img: card.dataset.img,
    desc: card.dataset.desc, id: card.dataset.id
  };
  document.getElementById('detailBreadcrumb').textContent = currentDetailProduct.name;
  document.getElementById('detailCat').textContent        = currentDetailProduct.cat;
  document.getElementById('detailName').textContent       = currentDetailProduct.name;
  document.getElementById('detailPriceNow').textContent   = '$' + currentDetailProduct.price.toLocaleString();
  document.getElementById('detailDesc').textContent       = currentDetailProduct.desc;
  document.getElementById('detailMainImg').src            = currentDetailProduct.img;
  document.getElementById('detailReviews').textContent    = '(' + (Math.floor(Math.random()*900)+50) + ' reviews)';
  document.getElementById('detailPriceWas').textContent   = '';
  document.getElementById('detailQty').value              = 1;
  document.getElementById('detailAddBtn').onclick = function(){
    var qty = parseInt(document.getElementById('detailQty').value);
    for(var i=0;i<qty;i++) addToCart(currentDetailProduct.name,currentDetailProduct.price,currentDetailProduct.img);
  };
  document.getElementById('detailThumbs').innerHTML = [1,2,3,4].map(function(i){
    return '<div class="thumb '+(i===1?'active':'')+'" onclick="setDetailThumb(this,\''+currentDetailProduct.img+'\')">' +
      '<img src="'+currentDetailProduct.img+'" alt="View '+i+'"/></div>';
  }).join('');
  showPage('detail');
}
//the name of item is comming from her
function injectCartItems() {
  var names = cartItems.map(function(i){ return i.name + ' ×' + i.qty; }).join(', ');
  var total = cartItems.reduce(function(s, i){ return s + (i.price * i.qty); }, 0);
  document.getElementById('cartItemsInput').value = names;
  document.getElementById('cartAmountInput').value = total;
}
function addToWishlistFromDetail() {
  if (!currentDetailProduct) return;
  addToWishlist(currentDetailProduct.name, currentDetailProduct.price, currentDetailProduct.img);
}

function setDetailThumb(el, url) {
  document.querySelectorAll('.thumb').forEach(function(t){ t.classList.remove('active'); });
  el.classList.add('active');
  document.getElementById('detailMainImg').src = url;
}

function changeQty(delta) {
  var input = document.getElementById('detailQty');
  input.value = Math.max(1, Math.min(10, parseInt(input.value) + delta));
}

function selectColor(dot) {
  document.querySelectorAll('.color-dot').forEach(function(d){ d.classList.remove('active'); });
  dot.classList.add('active');
}

function selectSize(btn) {
  document.querySelectorAll('.size-btn').forEach(function(b){ b.classList.remove('active'); });
  btn.classList.add('active');
}

/* ══════════════════════════════════════
   SEARCH & FILTER
══════════════════════════════════════ */
function filterProducts(query) {
  var cards = document.querySelectorAll('.product-card');
  var q = query.toLowerCase().trim();
  var visible = 0;
  cards.forEach(function(card){
    var match = !q || card.dataset.name.toLowerCase().includes(q) || card.dataset.category.toLowerCase().includes(q);
    card.classList.toggle('hidden', !match);
    if (match) visible++;
  });
  document.getElementById('noResults').style.display = visible===0 ? 'block' : 'none';
}

function filterByCategory(cat) {
  document.getElementById('searchInput').value = '';
  var cards = document.querySelectorAll('.product-card');
  var visible = 0;
  cards.forEach(function(card){
    var match = card.dataset.category === cat;
    card.classList.toggle('hidden', !match);
    if (match) visible++;
  });
  document.getElementById('noResults').style.display = visible===0 ? 'block' : 'none';
  showPage('home');
  setTimeout(function(){ document.getElementById('featured').scrollIntoView({behavior:'smooth'}); }, 100);
}

function clearFilter() {
  document.getElementById('searchInput').value = '';
  document.querySelectorAll('.product-card').forEach(function(c){ c.classList.remove('hidden'); });
  document.getElementById('noResults').style.display = 'none';
}

/* ══════════════════════════════════════
   CHECKOUT
══════════════════════════════════════ */
function renderCheckoutSummary() {
  var sub      = cartItems.reduce(function(s,i){ return s+i.price*i.qty; }, 0);
  var shipping = sub >= 100 ? 0 : 15;
  var tax      = Math.round(sub * 0.08);
  var total    = sub + shipping + tax;

  document.getElementById('checkoutItems').innerHTML = cartItems.length === 0
    ? '<p style="color:var(--gray);font-size:.85rem">No items. <span style="color:var(--gold);cursor:pointer" onclick="showPage(\'home\')">Continue shopping →</span></p>'
    : cartItems.map(function(item){
        return '<div class="summary-item">' +
          '<div class="summary-item-img"><img src="'+item.img+'" alt="'+item.name+'"/></div>' +
          '<div class="summary-item-info">'+item.name+(item.qty>1?' ×'+item.qty:'')+'</div>' +
          '<div class="summary-item-price">$'+(item.price*item.qty).toLocaleString()+'</div>' +
        '</div>';
      }).join('');

  document.getElementById('checkoutTotals').innerHTML =
    '<div class="sum-row"><span class="lbl">Subtotal</span><span>$'+sub.toLocaleString()+'</span></div>' +
    '<div class="sum-row"><span class="lbl">Shipping</span><span>'+(shipping===0?'<span style="color:var(--green)">Free</span>':'$'+shipping)+'</span></div>' +
    '<div class="sum-row"><span class="lbl">Tax (8%)</span><span>$'+tax+'</span></div>' +
    '<div class="sum-row total"><span class="lbl">Total</span><span class="val">$'+total.toLocaleString()+'</span></div>';
}

function selectPayment(el) {
  document.querySelectorAll('.payment-opt').forEach(function(o){
    o.classList.remove('selected'); o.querySelector('input').checked = false;
  });
  el.classList.add('selected'); el.querySelector('input').checked = true;
}

function placeOrder() {
  var first = document.getElementById('coFirst').value.trim();
  var email = document.getElementById('coEmail').value.trim();
  var addr  = document.getElementById('coAddr').value.trim();
  var city  = document.getElementById('coCity').value.trim();
  if (!first||!email||!addr||!city) { showToast('Please fill in all required fields', 'error'); return; }
  if (cartItems.length === 0) { showToast('Your cart is empty!', 'error'); return; }
  var orderId = '#NOIR-' + Math.floor(Math.random()*9000+1000);
  document.getElementById('orderIdDisplay').textContent = orderId;
  cartItems = []; cartTotal = 0; updateCartUI();
  openModal('orderModal');
}

/* ══════════════════════════════════════
   NEWSLETTER
══════════════════════════════════════ */
function subscribeNewsletter(e) {
  e.preventDefault();
  e.target.querySelector('input').value = '';
  showToast('✓ Welcome to the NOIR inner circle!');
}

/* ══════════════════════════════════════
   TOAST
══════════════════════════════════════ */
function showToast(msg, type) {
  var wrap = document.getElementById('toastWrap');
  var t = document.createElement('div');
  t.className = 'toast';
  if (type === 'error') t.style.borderLeftColor = 'var(--red)';
  t.innerHTML = '<span class="toast-msg">' + msg + '</span>';
  wrap.appendChild(t);
  setTimeout(function(){
    t.style.opacity = '0'; t.style.transform = 'translateX(30px)';
    t.style.transition = 'all .3s ease';
    setTimeout(function(){ t.remove(); }, 300);
  }, 2800);
}

/* ══════════════════════════════════════
   KEYBOARD
══════════════════════════════════════ */
document.addEventListener('keydown', function(e){
  if (e.key === 'Escape') { closeAllDrawers(); closeMobileNav();
    document.querySelectorAll('.modal-wrap').forEach(function(m){ m.classList.remove('open'); });
  }
});
</script>
</body>
</html>