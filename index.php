<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>LUXE — Premium eCommerce</title>
<style>
/* ════════════════════════════════════════
   CSS VARIABLES & RESET
════════════════════════════════════════ */
:root {
  --black: #0a0a0a;
  --dark: #111318;
  --dark2: #1a1d24;
  --card: #1e2128;
  --border: #2a2d36;
  --gold: #c9a84c;
  --gold2: #e8c96a;
  --white: #f5f3ee;
  --gray: #8a8d96;
  --light: #d0cec9;
  --red: #e05252;
  --green: #4caf7d;
  --radius: 12px;
  --shadow: 0 8px 32px rgba(0,0,0,0.4);
  --transition: all 0.3s cubic-bezier(0.4,0,0.2,1);
}
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
html{scroll-behavior:smooth}
body{font-family:'Georgia',serif;background:var(--dark);color:var(--white);line-height:1.6;overflow-x:hidden}
a{text-decoration:none;color:inherit}
button{cursor:pointer;border:none;outline:none;font-family:inherit}
img{max-width:100%;display:block}
ul{list-style:none}
input,select,textarea{font-family:inherit;outline:none}

/* ════════════════════════════════════════
   SCROLLBAR
════════════════════════════════════════ */
::-webkit-scrollbar{width:6px}
::-webkit-scrollbar-track{background:var(--dark)}
::-webkit-scrollbar-thumb{background:var(--gold);border-radius:3px}

/* ════════════════════════════════════════
   PAGES — only active page shown
════════════════════════════════════════ */
.page{display:none}
.page.active{display:block}

/* ════════════════════════════════════════
   NAVBAR
════════════════════════════════════════ */
.navbar{
  position:sticky;top:0;z-index:1000;
  background:rgba(10,10,10,0.95);
  backdrop-filter:blur(20px);
  border-bottom:1px solid var(--border);
  padding:0 5%;
  display:flex;align-items:center;justify-content:space-between;
  height:70px;
}
.nav-logo{
  font-size:1.6rem;letter-spacing:0.15em;font-weight:700;
  color:var(--gold);text-transform:uppercase;
}
.nav-links{display:flex;align-items:center;gap:2rem}
.nav-links a{
  font-size:0.82rem;letter-spacing:0.1em;text-transform:uppercase;
  color:var(--light);transition:var(--transition);
}
.nav-links a:hover{color:var(--gold)}
.nav-right{display:flex;align-items:center;gap:1.2rem}
.nav-icon-btn{
  background:none;color:var(--light);font-size:1.1rem;
  padding:8px;border-radius:50%;transition:var(--transition);
  position:relative;
}
.nav-icon-btn:hover{color:var(--gold);background:var(--card)}
.cart-count{
  position:absolute;top:-4px;right:-4px;
  background:var(--gold);color:var(--black);
  font-size:0.65rem;font-weight:700;
  width:18px;height:18px;border-radius:50%;
  display:flex;align-items:center;justify-content:center;
  font-family:sans-serif;
}
.hamburger{display:none;flex-direction:column;gap:5px;background:none;padding:8px}
.hamburger span{width:24px;height:2px;background:var(--white);border-radius:2px;transition:var(--transition)}
.mobile-menu{
  display:none;position:fixed;top:70px;left:0;right:0;
  background:var(--dark2);border-bottom:1px solid var(--border);
  padding:1.5rem 5%;z-index:999;
}
.mobile-menu.open{display:block}
.mobile-menu a{
  display:block;padding:0.75rem 0;
  border-bottom:1px solid var(--border);
  font-size:0.9rem;letter-spacing:0.08em;text-transform:uppercase;
}

/* ════════════════════════════════════════
   BUTTONS
════════════════════════════════════════ */
.btn{
  display:inline-flex;align-items:center;justify-content:center;gap:0.5rem;
  padding:0.75rem 1.8rem;border-radius:6px;
  font-size:0.82rem;letter-spacing:0.1em;text-transform:uppercase;
  font-weight:600;transition:var(--transition);font-family:inherit;
}
.btn-gold{background:var(--gold);color:var(--black)}
.btn-gold:hover{background:var(--gold2);transform:translateY(-2px);box-shadow:0 6px 20px rgba(201,168,76,0.4)}
.btn-outline{background:transparent;color:var(--white);border:1px solid var(--border)}
.btn-outline:hover{border-color:var(--gold);color:var(--gold)}
.btn-dark{background:var(--card);color:var(--white)}
.btn-dark:hover{background:var(--border)}
.btn-red{background:var(--red);color:var(--white)}
.btn-red:hover{opacity:0.85}
.btn-sm{padding:0.5rem 1.2rem;font-size:0.75rem}

/* ════════════════════════════════════════
   HERO SECTION
════════════════════════════════════════ */
.hero{
  min-height:90vh;display:flex;align-items:center;
  background:linear-gradient(135deg,var(--black) 0%,var(--dark2) 50%,#0d1117 100%);
  position:relative;overflow:hidden;padding:5% 5%;
}
.hero::before{
  content:'';position:absolute;inset:0;
  background:radial-gradient(ellipse at 70% 50%,rgba(201,168,76,0.12) 0%,transparent 70%);
}
.hero-content{max-width:600px;z-index:1;animation:fadeUp 0.8s ease}
.hero-tag{
  display:inline-block;
  background:rgba(201,168,76,0.15);
  color:var(--gold);border:1px solid rgba(201,168,76,0.3);
  padding:0.4rem 1rem;border-radius:50px;
  font-size:0.75rem;letter-spacing:0.15em;text-transform:uppercase;
  margin-bottom:1.5rem;
}
.hero h1{
  font-size:clamp(2.5rem,6vw,4.5rem);
  line-height:1.1;margin-bottom:1.5rem;
  color:var(--white);
}
.hero h1 span{color:var(--gold)}
.hero p{color:var(--gray);font-size:1.05rem;margin-bottom:2.5rem;max-width:450px}
.hero-btns{display:flex;gap:1rem;flex-wrap:wrap}
.hero-visual{
  position:absolute;right:5%;top:50%;transform:translateY(-50%);
  width:min(45%,500px);z-index:1;
}
.hero-card{
  background:var(--card);border:1px solid var(--border);
  border-radius:20px;padding:2rem;
  box-shadow:var(--shadow);
  animation:float 4s ease-in-out infinite;
}
.hero-card-img{
  width:100%;height:260px;object-fit:cover;border-radius:12px;
  background:linear-gradient(135deg,#2a2d36,#1a1d24);
  display:flex;align-items:center;justify-content:center;
  font-size:5rem;
}
.hero-card-info{padding-top:1.2rem}
.hero-card-info h3{font-size:1.1rem;margin-bottom:0.3rem}
.hero-card-info .price{color:var(--gold);font-size:1.3rem;font-weight:700}
@keyframes float{0%,100%{transform:translateY(-50%) translateX(0)}50%{transform:translateY(-52%) translateX(-8px)}}
@keyframes fadeUp{from{opacity:0;transform:translateY(30px)}to{opacity:1;transform:translateY(0)}}

/* ════════════════════════════════════════
   SECTION TITLES
════════════════════════════════════════ */
.section{padding:5rem 5%}
.section-header{text-align:center;margin-bottom:3rem}
.section-tag{
  display:inline-block;color:var(--gold);
  font-size:0.75rem;letter-spacing:0.2em;text-transform:uppercase;
  margin-bottom:0.75rem;
}
.section-title{font-size:clamp(1.6rem,4vw,2.5rem);color:var(--white)}
.section-sub{color:var(--gray);margin-top:0.75rem;font-size:0.95rem}

/* ════════════════════════════════════════
   PRODUCT CARD
════════════════════════════════════════ */
.products-grid{
  display:grid;
  grid-template-columns:repeat(auto-fill,minmax(240px,1fr));
  gap:1.5rem;
}
.product-card{
  background:var(--card);border:1px solid var(--border);
  border-radius:var(--radius);overflow:hidden;
  transition:var(--transition);position:relative;
}
.product-card:hover{transform:translateY(-6px);border-color:var(--gold);box-shadow:var(--shadow)}
.product-badge{
  position:absolute;top:12px;left:12px;z-index:2;
  background:var(--gold);color:var(--black);
  font-size:0.7rem;font-weight:700;letter-spacing:0.08em;
  padding:3px 10px;border-radius:50px;text-transform:uppercase;
}
.product-badge.sale{background:var(--red);color:white}
.product-img{
  width:100%;height:220px;
  background:linear-gradient(135deg,var(--dark2),var(--border));
  display:flex;align-items:center;justify-content:center;
  font-size:4rem;transition:var(--transition);
  overflow:hidden;position:relative;
}
.product-card:hover .product-img{transform:scale(1.03)}
.product-actions{
  position:absolute;inset:0;
  background:rgba(0,0,0,0.5);
  display:flex;align-items:center;justify-content:center;gap:0.75rem;
  opacity:0;transition:var(--transition);
}
.product-card:hover .product-actions{opacity:1}
.product-action-btn{
  background:var(--white);color:var(--black);
  border:none;padding:8px 16px;border-radius:6px;
  font-size:0.75rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;
  cursor:pointer;transition:var(--transition);
}
.product-action-btn:hover{background:var(--gold)}
.product-body{padding:1.25rem}
.product-cat{font-size:0.72rem;color:var(--gold);letter-spacing:0.1em;text-transform:uppercase;margin-bottom:0.4rem}
.product-name{font-size:0.95rem;color:var(--white);margin-bottom:0.5rem;line-height:1.4}
.product-rating{display:flex;align-items:center;gap:0.4rem;margin-bottom:0.75rem}
.stars{color:var(--gold);font-size:0.8rem;letter-spacing:2px}
.rating-count{color:var(--gray);font-size:0.75rem}
.product-price{display:flex;align-items:center;gap:0.75rem}
.price-current{font-size:1.15rem;font-weight:700;color:var(--gold)}
.price-old{font-size:0.85rem;color:var(--gray);text-decoration:line-through}
.product-footer{padding:0 1.25rem 1.25rem}

/* ════════════════════════════════════════
   CATEGORIES
════════════════════════════════════════ */
.categories-grid{
  display:grid;
  grid-template-columns:repeat(auto-fill,minmax(160px,1fr));
  gap:1.2rem;
}
.category-card{
  background:var(--card);border:1px solid var(--border);
  border-radius:var(--radius);padding:2rem 1rem;
  text-align:center;cursor:pointer;transition:var(--transition);
}
.category-card:hover{border-color:var(--gold);transform:translateY(-4px)}
.category-icon{font-size:2.5rem;margin-bottom:0.75rem}
.category-name{font-size:0.85rem;letter-spacing:0.06em;text-transform:uppercase;color:var(--light)}
.category-count{font-size:0.72rem;color:var(--gray);margin-top:0.3rem}

/* ════════════════════════════════════════
   PROMO SECTION
════════════════════════════════════════ */
.promo-section{
  background:linear-gradient(135deg,var(--black),var(--dark2));
  margin:0 5%;border-radius:20px;
  padding:4rem 5%;
  display:grid;grid-template-columns:1fr 1fr;gap:3rem;align-items:center;
  border:1px solid var(--border);position:relative;overflow:hidden;
}
.promo-section::before{
  content:'';position:absolute;
  right:-100px;top:-100px;
  width:400px;height:400px;
  background:radial-gradient(circle,rgba(201,168,76,0.1),transparent 60%);
  border-radius:50%;
}
.promo-tag{
  background:rgba(201,168,76,0.15);color:var(--gold);
  border:1px solid rgba(201,168,76,0.3);
  display:inline-block;padding:0.4rem 1rem;border-radius:50px;
  font-size:0.75rem;letter-spacing:0.15em;text-transform:uppercase;
  margin-bottom:1.2rem;
}
.promo-section h2{font-size:clamp(1.5rem,3vw,2.2rem);margin-bottom:1rem}
.promo-section p{color:var(--gray);margin-bottom:1.5rem}
.promo-features{display:flex;flex-direction:column;gap:0.75rem;margin-bottom:2rem}
.promo-feature{display:flex;align-items:center;gap:0.75rem;color:var(--light);font-size:0.9rem}
.promo-feature::before{content:'✓';color:var(--gold);font-weight:700}
.promo-visual{text-align:center;font-size:8rem;animation:float2 3s ease-in-out infinite}
@keyframes float2{0%,100%{transform:translateY(0)}50%{transform:translateY(-15px)}}

/* ════════════════════════════════════════
   STATS BAR
════════════════════════════════════════ */
.stats-bar{
  background:var(--card);border-top:1px solid var(--border);border-bottom:1px solid var(--border);
  padding:2.5rem 5%;
  display:grid;grid-template-columns:repeat(4,1fr);gap:2rem;
  text-align:center;
}
.stat-item h3{font-size:2rem;color:var(--gold);font-weight:700}
.stat-item p{color:var(--gray);font-size:0.82rem;text-transform:uppercase;letter-spacing:0.1em;margin-top:0.3rem}

/* ════════════════════════════════════════
   FOOTER
════════════════════════════════════════ */
footer{
  background:var(--black);border-top:1px solid var(--border);
  padding:4rem 5% 2rem;
}
.footer-grid{
  display:grid;grid-template-columns:2fr 1fr 1fr 1fr;
  gap:3rem;margin-bottom:3rem;
}
.footer-brand .logo{font-size:1.4rem;color:var(--gold);letter-spacing:0.15em;font-weight:700;text-transform:uppercase;margin-bottom:1rem}
.footer-brand p{color:var(--gray);font-size:0.88rem;line-height:1.7;margin-bottom:1.5rem}
.social-links{display:flex;gap:0.75rem}
.social-btn{
  width:38px;height:38px;background:var(--card);border:1px solid var(--border);
  border-radius:8px;display:flex;align-items:center;justify-content:center;
  font-size:1rem;transition:var(--transition);
}
.social-btn:hover{border-color:var(--gold);color:var(--gold)}
.footer-col h4{font-size:0.8rem;letter-spacing:0.15em;text-transform:uppercase;color:var(--white);margin-bottom:1.2rem}
.footer-col ul li{margin-bottom:0.6rem}
.footer-col ul li a{color:var(--gray);font-size:0.88rem;transition:var(--transition)}
.footer-col ul li a:hover{color:var(--gold)}
.footer-bottom{
  border-top:1px solid var(--border);padding-top:2rem;
  display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:1rem;
}
.footer-bottom p{color:var(--gray);font-size:0.82rem}

/* ════════════════════════════════════════
   PRODUCT LISTING PAGE
════════════════════════════════════════ */
.page-hero{
  background:linear-gradient(135deg,var(--black),var(--dark2));
  padding:4rem 5% 3rem;border-bottom:1px solid var(--border);
}
.page-hero h1{font-size:clamp(1.8rem,4vw,3rem);margin-bottom:0.5rem}
.page-hero p{color:var(--gray)}
.breadcrumb{display:flex;align-items:center;gap:0.5rem;font-size:0.8rem;color:var(--gray);margin-bottom:1.2rem}
.breadcrumb a:hover{color:var(--gold)}
.breadcrumb span{color:var(--border)}
.shop-layout{display:grid;grid-template-columns:260px 1fr;gap:2rem;padding:3rem 5%}
.filters-sidebar{position:sticky;top:90px;height:fit-content}
.filter-group{margin-bottom:2rem}
.filter-title{
  font-size:0.78rem;letter-spacing:0.12em;text-transform:uppercase;
  color:var(--light);margin-bottom:1rem;padding-bottom:0.5rem;
  border-bottom:1px solid var(--border);
}
.filter-options{display:flex;flex-direction:column;gap:0.6rem}
.filter-option{display:flex;align-items:center;gap:0.75rem;cursor:pointer}
.filter-option input{
  width:16px;height:16px;accent-color:var(--gold);cursor:pointer;
}
.filter-option label{font-size:0.88rem;color:var(--gray);cursor:pointer;transition:var(--transition)}
.filter-option:hover label{color:var(--white)}
.price-range{margin-top:0.75rem}
.price-range input[type=range]{
  width:100%;accent-color:var(--gold);
  -webkit-appearance:none;height:4px;background:var(--border);border-radius:2px;
}
.price-labels{display:flex;justify-content:space-between;font-size:0.8rem;color:var(--gray);margin-top:0.5rem}
.shop-header{
  display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:1rem;
  margin-bottom:1.5rem;
}
.result-count{color:var(--gray);font-size:0.88rem}
.shop-controls{display:flex;align-items:center;gap:1rem}
.search-box{
  display:flex;align-items:center;gap:0.5rem;
  background:var(--card);border:1px solid var(--border);
  border-radius:8px;padding:0.5rem 1rem;
  transition:var(--transition);
}
.search-box:focus-within{border-color:var(--gold)}
.search-box input{background:none;border:none;color:var(--white);font-size:0.88rem;width:200px}
.search-box input::placeholder{color:var(--gray)}
.sort-select{
  background:var(--card);border:1px solid var(--border);
  color:var(--white);padding:0.5rem 1rem;border-radius:8px;font-size:0.85rem;
  cursor:pointer;
}

/* ════════════════════════════════════════
   PRODUCT DETAIL PAGE
════════════════════════════════════════ */
.product-detail{padding:3rem 5%;display:grid;grid-template-columns:1fr 1fr;gap:4rem}
.detail-gallery .main-img{
  width:100%;height:450px;
  background:linear-gradient(135deg,var(--dark2),var(--border));
  border-radius:var(--radius);
  display:flex;align-items:center;justify-content:center;
  font-size:8rem;border:1px solid var(--border);margin-bottom:1rem;
}
.thumbs{display:flex;gap:1rem}
.thumb{
  width:80px;height:80px;
  background:var(--card);border:1px solid var(--border);
  border-radius:8px;cursor:pointer;display:flex;align-items:center;justify-content:center;
  font-size:1.5rem;transition:var(--transition);
}
.thumb.active,.thumb:hover{border-color:var(--gold)}
.detail-info{padding-top:1rem}
.detail-cat{font-size:0.75rem;color:var(--gold);letter-spacing:0.12em;text-transform:uppercase;margin-bottom:0.75rem}
.detail-name{font-size:clamp(1.5rem,3vw,2rem);margin-bottom:1rem}
.detail-rating{display:flex;align-items:center;gap:1rem;margin-bottom:1.5rem}
.detail-price{margin-bottom:1.5rem}
.detail-price .current{font-size:2rem;color:var(--gold);font-weight:700}
.detail-price .old{color:var(--gray);text-decoration:line-through;margin-left:0.75rem;font-size:1rem}
.detail-desc{color:var(--gray);font-size:0.92rem;line-height:1.8;margin-bottom:1.5rem;padding-bottom:1.5rem;border-bottom:1px solid var(--border)}
.detail-options{margin-bottom:1.5rem}
.option-title{font-size:0.8rem;letter-spacing:0.1em;text-transform:uppercase;color:var(--light);margin-bottom:0.75rem}
.color-options{display:flex;gap:0.75rem}
.color-dot{
  width:28px;height:28px;border-radius:50%;cursor:pointer;
  border:2px solid transparent;transition:var(--transition);
}
.color-dot.active,.color-dot:hover{border-color:var(--white);transform:scale(1.15)}
.size-options{display:flex;gap:0.5rem;flex-wrap:wrap}
.size-btn{
  padding:0.4rem 0.9rem;background:var(--card);border:1px solid var(--border);
  border-radius:6px;font-size:0.82rem;color:var(--gray);cursor:pointer;transition:var(--transition);
}
.size-btn.active,.size-btn:hover{border-color:var(--gold);color:var(--gold)}
.qty-row{display:flex;align-items:center;gap:1.5rem;margin-bottom:2rem}
.qty-control{
  display:flex;align-items:center;
  background:var(--card);border:1px solid var(--border);border-radius:8px;overflow:hidden;
}
.qty-btn{
  background:none;color:var(--white);width:40px;height:40px;
  font-size:1.2rem;transition:var(--transition);
}
.qty-btn:hover{background:var(--border)}
.qty-val{width:50px;text-align:center;font-size:1rem;color:var(--white);background:none;border:none}
.detail-btns{display:flex;gap:1rem;flex-wrap:wrap}
.reviews{padding:3rem 5%;border-top:1px solid var(--border)}
.review-card{
  background:var(--card);border:1px solid var(--border);
  border-radius:var(--radius);padding:1.5rem;margin-bottom:1rem;
}
.review-header{display:flex;align-items:center;justify-content:space-between;margin-bottom:0.75rem}
.reviewer{font-weight:600;font-size:0.9rem}
.review-date{color:var(--gray);font-size:0.8rem}
.review-text{color:var(--gray);font-size:0.9rem;line-height:1.7}

/* ════════════════════════════════════════
   CART PAGE
════════════════════════════════════════ */
.cart-layout{padding:3rem 5%;display:grid;grid-template-columns:1fr 360px;gap:2rem;align-items:start}
.cart-table{background:var(--card);border:1px solid var(--border);border-radius:var(--radius);overflow:hidden}
.cart-table-head{
  display:grid;grid-template-columns:3fr 1fr 1.2fr 1fr 40px;
  padding:1rem 1.5rem;background:var(--dark2);
  font-size:0.75rem;letter-spacing:0.1em;text-transform:uppercase;color:var(--gray);
  gap:1rem;
}
.cart-row{
  display:grid;grid-template-columns:3fr 1fr 1.2fr 1fr 40px;
  padding:1.25rem 1.5rem;gap:1rem;align-items:center;
  border-top:1px solid var(--border);
}
.cart-product{display:flex;align-items:center;gap:1rem}
.cart-img{
  width:70px;height:70px;background:var(--dark2);
  border-radius:8px;display:flex;align-items:center;justify-content:center;
  font-size:1.8rem;flex-shrink:0;border:1px solid var(--border);
}
.cart-product-name{font-size:0.9rem;margin-bottom:0.25rem}
.cart-product-cat{font-size:0.75rem;color:var(--gray)}
.cart-price{color:var(--gold);font-weight:600}
.cart-qty-control{
  display:flex;align-items:center;
  background:var(--dark2);border:1px solid var(--border);border-radius:6px;overflow:hidden;
  width:fit-content;
}
.cart-qty-btn{background:none;color:var(--white);width:32px;height:32px;font-size:1rem}
.cart-qty-btn:hover{background:var(--border)}
.cart-qty-val{width:36px;text-align:center;font-size:0.88rem;color:var(--white);background:none;border:none}
.cart-total{color:var(--white);font-weight:600}
.cart-remove{background:none;color:var(--gray);font-size:1.1rem;transition:var(--transition);width:32px;height:32px;border-radius:6px}
.cart-remove:hover{color:var(--red);background:rgba(224,82,82,0.1)}
.cart-summary{background:var(--card);border:1px solid var(--border);border-radius:var(--radius);padding:1.5rem;position:sticky;top:90px}
.summary-title{font-size:1.1rem;margin-bottom:1.5rem;padding-bottom:1rem;border-bottom:1px solid var(--border)}
.summary-row{display:flex;justify-content:space-between;margin-bottom:0.75rem;font-size:0.9rem}
.summary-row .label{color:var(--gray)}
.summary-row.total{
  font-size:1.1rem;font-weight:700;
  margin-top:1.5rem;padding-top:1rem;border-top:1px solid var(--border);
}
.summary-row.total .value{color:var(--gold)}
.promo-input{
  display:flex;gap:0.5rem;margin:1.5rem 0;
}
.promo-input input{
  flex:1;background:var(--dark2);border:1px solid var(--border);
  color:var(--white);padding:0.6rem 1rem;border-radius:6px;font-size:0.85rem;
}
.promo-input input::placeholder{color:var(--gray)}
.empty-cart{text-align:center;padding:4rem 2rem}
.empty-cart .icon{font-size:4rem;margin-bottom:1rem}
.empty-cart h3{font-size:1.2rem;margin-bottom:0.5rem}
.empty-cart p{color:var(--gray);margin-bottom:1.5rem}

/* ════════════════════════════════════════
   CHECKOUT PAGE
════════════════════════════════════════ */
.checkout-layout{padding:3rem 5%;display:grid;grid-template-columns:1fr 380px;gap:2.5rem;align-items:start}
.checkout-form-box{background:var(--card);border:1px solid var(--border);border-radius:var(--radius);padding:2rem;margin-bottom:1.5rem}
.form-section-title{font-size:0.85rem;letter-spacing:0.12em;text-transform:uppercase;color:var(--gold);margin-bottom:1.5rem;padding-bottom:0.75rem;border-bottom:1px solid var(--border)}
.form-grid{display:grid;grid-template-columns:1fr 1fr;gap:1rem}
.form-grid.full{grid-template-columns:1fr}
.form-group{display:flex;flex-direction:column;gap:0.4rem}
.form-group label{font-size:0.8rem;letter-spacing:0.08em;text-transform:uppercase;color:var(--gray)}
.form-group input,.form-group select,.form-group textarea{
  background:var(--dark2);border:1px solid var(--border);
  color:var(--white);padding:0.75rem 1rem;border-radius:8px;font-size:0.9rem;
  transition:var(--transition);
}
.form-group input:focus,.form-group select:focus{border-color:var(--gold)}
.form-group select option{background:var(--dark2)}
.form-group textarea{resize:vertical;min-height:80px}
.form-group .error-msg{color:var(--red);font-size:0.78rem;display:none}
.form-group.invalid input,.form-group.invalid select{border-color:var(--red)}
.form-group.invalid .error-msg{display:block}
.payment-options{display:flex;flex-direction:column;gap:0.75rem}
.payment-option{
  display:flex;align-items:center;gap:1rem;
  background:var(--dark2);border:1px solid var(--border);
  border-radius:8px;padding:1rem;cursor:pointer;transition:var(--transition);
}
.payment-option:has(input:checked),.payment-option.selected{border-color:var(--gold)}
.payment-option input{accent-color:var(--gold)}
.payment-label{font-size:0.88rem}
.order-items{margin-bottom:1rem}
.order-item{display:flex;align-items:center;gap:1rem;padding:0.75rem 0;border-bottom:1px solid var(--border)}
.order-item-img{width:50px;height:50px;background:var(--dark2);border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:1.2rem;flex-shrink:0}
.order-item-info{flex:1;font-size:0.85rem}
.order-item-info p{color:var(--gray);font-size:0.78rem}
.order-item-price{color:var(--gold);font-weight:600;font-size:0.9rem}

/* ════════════════════════════════════════
   AUTH PAGES
════════════════════════════════════════ */
.auth-page{
  min-height:100vh;
  display:flex;align-items:center;justify-content:center;
  background:linear-gradient(135deg,var(--black),var(--dark2));
  padding:2rem;
}
.auth-card{
  background:var(--card);border:1px solid var(--border);
  border-radius:20px;padding:3rem;width:100%;max-width:440px;
  box-shadow:var(--shadow);
}
.auth-logo{text-align:center;font-size:1.6rem;color:var(--gold);letter-spacing:0.15em;font-weight:700;text-transform:uppercase;margin-bottom:0.5rem}
.auth-subtitle{text-align:center;color:var(--gray);font-size:0.88rem;margin-bottom:2.5rem}
.auth-form{display:flex;flex-direction:column;gap:1.2rem}
.auth-divider{text-align:center;color:var(--gray);font-size:0.8rem;position:relative;margin:0.5rem 0}
.auth-divider::before,.auth-divider::after{content:'';position:absolute;top:50%;width:42%;height:1px;background:var(--border)}
.auth-divider::before{left:0}
.auth-divider::after{right:0}
.auth-footer{text-align:center;margin-top:1.5rem;font-size:0.88rem;color:var(--gray)}
.auth-footer a{color:var(--gold)}
.auth-footer a:hover{text-decoration:underline}

/* ════════════════════════════════════════
   ADMIN PANEL
════════════════════════════════════════ */
.admin-layout{display:grid;grid-template-columns:240px 1fr;min-height:100vh}
.admin-sidebar{
  background:var(--black);border-right:1px solid var(--border);
  padding:0;position:sticky;top:0;height:100vh;overflow-y:auto;
}
.admin-logo{padding:1.5rem;font-size:1.2rem;color:var(--gold);letter-spacing:0.12em;font-weight:700;text-transform:uppercase;border-bottom:1px solid var(--border)}
.admin-nav{padding:1rem 0}
.admin-nav-item{
  display:flex;align-items:center;gap:0.75rem;
  padding:0.85rem 1.5rem;
  font-size:0.85rem;color:var(--gray);cursor:pointer;transition:var(--transition);
  border-left:3px solid transparent;
}
.admin-nav-item:hover,.admin-nav-item.active{color:var(--gold);background:rgba(201,168,76,0.08);border-left-color:var(--gold)}
.admin-nav-icon{font-size:1.1rem;width:20px;text-align:center}
.admin-content{background:var(--dark);padding:2.5rem;overflow:auto}
.admin-top{display:flex;align-items:center;justify-content:space-between;margin-bottom:2.5rem}
.admin-top h1{font-size:1.4rem}
.stats-cards{display:grid;grid-template-columns:repeat(4,1fr);gap:1.5rem;margin-bottom:2.5rem}
.stat-card{
  background:var(--card);border:1px solid var(--border);
  border-radius:var(--radius);padding:1.5rem;transition:var(--transition);
}
.stat-card:hover{border-color:var(--gold)}
.stat-card-icon{font-size:2rem;margin-bottom:0.75rem}
.stat-card-value{font-size:1.8rem;font-weight:700;color:var(--gold)}
.stat-card-label{color:var(--gray);font-size:0.8rem;text-transform:uppercase;letter-spacing:0.08em;margin-top:0.25rem}
.stat-card-change{font-size:0.78rem;color:var(--green);margin-top:0.5rem}
.admin-section{background:var(--card);border:1px solid var(--border);border-radius:var(--radius);overflow:hidden;margin-bottom:2rem}
.admin-section-head{padding:1.25rem 1.5rem;display:flex;align-items:center;justify-content:space-between;border-bottom:1px solid var(--border)}
.admin-section-head h3{font-size:0.95rem}
.data-table{width:100%;border-collapse:collapse}
.data-table th{
  padding:0.85rem 1.25rem;text-align:left;
  font-size:0.72rem;letter-spacing:0.1em;text-transform:uppercase;color:var(--gray);
  background:var(--dark2);border-bottom:1px solid var(--border);
}
.data-table td{padding:1rem 1.25rem;font-size:0.88rem;border-bottom:1px solid var(--border)}
.data-table tr:last-child td{border-bottom:none}
.data-table tr:hover td{background:rgba(255,255,255,0.02)}
.status-badge{
  display:inline-block;padding:0.25rem 0.75rem;border-radius:50px;
  font-size:0.72rem;font-weight:600;letter-spacing:0.06em;text-transform:uppercase;
}
.status-pending{background:rgba(255,165,0,0.15);color:orange}
.status-processing{background:rgba(33,150,243,0.15);color:#64b5f6}
.status-shipped{background:rgba(76,175,77,0.15);color:var(--green)}
.status-delivered{background:rgba(201,168,76,0.15);color:var(--gold)}
.status-cancelled{background:rgba(224,82,82,0.15);color:var(--red)}
.add-product-form{padding:1.5rem;display:grid;grid-template-columns:1fr 1fr;gap:1rem}
.add-product-form .full{grid-column:1/-1}
.table-actions{display:flex;gap:0.5rem}
.action-btn{
  padding:0.35rem 0.75rem;border-radius:5px;font-size:0.75rem;
  font-weight:600;letter-spacing:0.06em;text-transform:uppercase;
  cursor:pointer;transition:var(--transition);border:none;
}
.action-edit{background:rgba(33,150,243,0.15);color:#64b5f6}
.action-edit:hover{background:rgba(33,150,243,0.3)}
.action-del{background:rgba(224,82,82,0.15);color:var(--red)}
.action-del:hover{background:rgba(224,82,82,0.3)}

/* ════════════════════════════════════════
   TOAST
════════════════════════════════════════ */
.toast-container{position:fixed;bottom:2rem;right:2rem;z-index:9999;display:flex;flex-direction:column;gap:0.75rem}
.toast{
  background:var(--card);border:1px solid var(--border);
  border-radius:10px;padding:1rem 1.5rem;
  display:flex;align-items:center;gap:0.75rem;
  min-width:280px;box-shadow:var(--shadow);
  animation:slideIn 0.3s ease;
}
.toast.success{border-left:3px solid var(--green)}
.toast.error{border-left:3px solid var(--red)}
.toast.info{border-left:3px solid var(--gold)}
@keyframes slideIn{from{transform:translateX(120%);opacity:0}to{transform:translateX(0);opacity:1}}
.toast-icon{font-size:1.2rem}
.toast-msg{font-size:0.88rem}

/* ════════════════════════════════════════
   MODAL
════════════════════════════════════════ */
.modal-overlay{
  position:fixed;inset:0;background:rgba(0,0,0,0.8);
  z-index:2000;display:flex;align-items:center;justify-content:center;
  padding:2rem;opacity:0;pointer-events:none;transition:var(--transition);
}
.modal-overlay.open{opacity:1;pointer-events:all}
.modal{
  background:var(--card);border:1px solid var(--border);
  border-radius:20px;padding:2.5rem;width:100%;max-width:500px;
  box-shadow:var(--shadow);transform:scale(0.9);transition:var(--transition);
}
.modal-overlay.open .modal{transform:scale(1)}
.modal-head{display:flex;align-items:center;justify-content:space-between;margin-bottom:2rem}
.modal-head h3{font-size:1.1rem}
.modal-close{background:none;color:var(--gray);font-size:1.4rem;transition:var(--transition)}
.modal-close:hover{color:var(--white)}

/* ════════════════════════════════════════
   RESPONSIVE
════════════════════════════════════════ */
@media(max-width:1024px){
  .shop-layout{grid-template-columns:1fr}
  .filters-sidebar{display:none}
  .product-detail{grid-template-columns:1fr;gap:2rem}
  .cart-layout,.checkout-layout{grid-template-columns:1fr}
  .admin-layout{grid-template-columns:1fr}
  .admin-sidebar{display:none}
  .stats-cards{grid-template-columns:1fr 1fr}
  .footer-grid{grid-template-columns:1fr 1fr}
}
@media(max-width:768px){
  .nav-links{display:none}
  .hamburger{display:flex}
  .hero{min-height:70vh}
  .hero-visual{display:none}
  .promo-section{grid-template-columns:1fr}
  .promo-visual{display:none}
  .stats-bar{grid-template-columns:1fr 1fr}
  .cart-table-head,.cart-row{grid-template-columns:2fr 1fr 1fr;font-size:0.82rem}
  .cart-table-head .hide-mobile,.cart-row .hide-mobile{display:none}
  .product-detail{grid-template-columns:1fr}
  .footer-grid{grid-template-columns:1fr}
  .add-product-form{grid-template-columns:1fr}
  .stats-cards{grid-template-columns:1fr}
  .form-grid{grid-template-columns:1fr}
}

/* ════════════════════════════════════════
   UTILS
════════════════════════════════════════ */
.text-gold{color:var(--gold)}
.text-gray{color:var(--gray)}
.mt-1{margin-top:0.5rem}
.mt-2{margin-top:1rem}
.flex{display:flex}
.items-center{align-items:center}
.gap-1{gap:0.5rem}
.gap-2{gap:1rem}
.w-full{width:100%}
</style>
</head>
<body>

<!-- ════════════════════════════════════════
     NAVBAR
════════════════════════════════════════ -->
<nav class="navbar" id="navbar">
  <div class="nav-logo nav-btn" data-page="home" style="cursor:pointer">LUXE</div>
  <div class="nav-links">
    <a class="nav-btn" data-page="home">Home</a>
    <a class="nav-btn" data-page="shop">Shop</a>
    <a class="nav-btn" data-page="cart">Cart</a>
    <a class="nav-btn" data-page="checkout">Checkout</a>
    <a class="nav-btn" data-page="login" style="color:var(--gold);border:1px solid var(--gold);padding:6px 16px;border-radius:6px;">Login</a>
    <a class="nav-btn" data-page="register" style="background:var(--gold);color:var(--black);padding:6px 16px;border-radius:6px;font-weight:700;">Register</a>
  </div>
  <div class="nav-right">
    <button class="nav-icon-btn nav-btn" data-page="login" title="Login">👤</button>
    <button class="nav-icon-btn nav-btn" data-page="cart" title="Cart">
      🛒
      <span class="cart-count" id="cart-count">0</span>
    </button>
    <button class="hamburger" id="hamburger-btn" aria-label="Menu">
      <span></span><span></span><span></span>
    </button>
  </div>
</nav>

<!-- Mobile Menu -->
<div class="mobile-menu" id="mobile-menu">
  <a class="nav-btn mob-nav" data-page="home">Home</a>
  <a class="nav-btn mob-nav" data-page="shop">Shop</a>
  <a class="nav-btn mob-nav" data-page="cart">Cart</a>
  <a class="nav-btn mob-nav" data-page="checkout">Checkout</a>
  <a class="nav-btn mob-nav" data-page="login" style="color:var(--gold)">🔐 Login</a>
  <a class="nav-btn mob-nav" data-page="register" style="color:var(--gold)">📝 Register</a>
</div>

<!-- ════════════════════════════════════════
     HOME PAGE
════════════════════════════════════════ -->
<div class="page active" id="page-home">

  <!-- Hero -->
  <section class="hero">
    <div class="hero-content">
      <div class="hero-tag">✦ New Collection 2025</div>
      <h1>Discover <span>Premium</span> Quality Products</h1>
      <p>Curated selection of luxury goods crafted for the discerning customer. Elevate your lifestyle with LUXE.</p>
      <div class="hero-btns">
        <button class="btn btn-gold" onclick="showPage('shop')">Shop Now →</button>
        <button class="btn btn-outline" onclick="showPage('shop')">View Catalog</button>
      </div>
    </div>
    <div class="hero-visual">
      <div class="hero-card">
        <div class="hero-card-img">👑</div>
        <div class="hero-card-info">
          <h3>Premium Gold Watch</h3>
          <div class="price">$1,299.00</div>
        </div>
      </div>
    </div>
  </section>

  <!-- Stats -->
  <div class="stats-bar">
    <div class="stat-item"><h3>50K+</h3><p>Happy Customers</p></div>
    <div class="stat-item"><h3>2K+</h3><p>Premium Products</p></div>
    <div class="stat-item"><h3>120+</h3><p>Global Brands</p></div>
    <div class="stat-item"><h3>4.9★</h3><p>Average Rating</p></div>
  </div>

  <!-- Categories -->
  <section class="section">
    <div class="section-header">
      <div class="section-tag">Browse</div>
      <h2 class="section-title">Shop by Category</h2>
      <p class="section-sub">Find exactly what you're looking for</p>
    </div>
    <div class="categories-grid">
      <div class="category-card" onclick="filterCategory('Electronics')">
        <div class="category-icon">📱</div>
        <div class="category-name">Electronics</div>
        <div class="category-count">142 items</div>
      </div>
      <div class="category-card" onclick="filterCategory('Fashion')">
        <div class="category-icon">👗</div>
        <div class="category-name">Fashion</div>
        <div class="category-count">389 items</div>
      </div>
      <div class="category-card" onclick="filterCategory('Watches')">
        <div class="category-icon">⌚</div>
        <div class="category-name">Watches</div>
        <div class="category-count">76 items</div>
      </div>
      <div class="category-card" onclick="filterCategory('Jewelry')">
        <div class="category-icon">💎</div>
        <div class="category-name">Jewelry</div>
        <div class="category-count">203 items</div>
      </div>
      <div class="category-card" onclick="filterCategory('Home')">
        <div class="category-icon">🏠</div>
        <div class="category-name">Home & Living</div>
        <div class="category-count">155 items</div>
      </div>
      <div class="category-card" onclick="filterCategory('Beauty')">
        <div class="category-icon">✨</div>
        <div class="category-name">Beauty</div>
        <div class="category-count">98 items</div>
      </div>
    </div>
  </section>

  <!-- Featured Products -->
  <section class="section" style="background:var(--dark2);padding-top:4rem;padding-bottom:4rem">
    <div class="section-header">
      <div class="section-tag">Curated</div>
      <h2 class="section-title">Featured Products</h2>
      <p class="section-sub">Hand-picked premium items just for you</p>
    </div>
    <div class="products-grid" id="featured-products"></div>
    <div style="text-align:center;margin-top:2.5rem">
      <button class="btn btn-outline" onclick="showPage('shop')">View All Products →</button>
    </div>
  </section>

  <!-- Promo -->
  <section class="section">
    <div class="promo-section">
      <div>
        <div class="promo-tag">Limited Time Offer</div>
        <h2>Up to 40% Off<br/>Premium Collection</h2>
        <p>Don't miss our biggest sale of the season. Shop premium quality at unbeatable prices.</p>
        <div class="promo-features">
          <div class="promo-feature">Free worldwide shipping on orders $100+</div>
          <div class="promo-feature">30-day hassle-free returns</div>
          <div class="promo-feature">Authentic products, guaranteed</div>
          <div class="promo-feature">24/7 customer support</div>
        </div>
        <button class="btn btn-gold" onclick="showPage('shop')">Shop the Sale</button>
      </div>
      <div class="promo-visual">🎁</div>
    </div>
  </section>

  <!-- Footer -->
  <footer>
    <div class="footer-grid">
      <div class="footer-brand">
        <div class="logo">LUXE</div>
        <p>Your destination for premium products and luxury goods. We curate only the finest items for our discerning customers.</p>
        <div class="social-links">
          <a class="social-btn" title="Facebook">f</a>
          <a class="social-btn" title="Twitter">𝕏</a>
          <a class="social-btn" title="Instagram">📷</a>
          <a class="social-btn" title="Pinterest">P</a>
        </div>
      </div>
      <div class="footer-col">
        <h4>Shop</h4>
        <ul>
          <li><a onclick="showPage('shop')">All Products</a></li>
          <li><a href="#">New Arrivals</a></li>
          <li><a href="#">Best Sellers</a></li>
          <li><a href="#">Sale</a></li>
        </ul>
      </div>
      <div class="footer-col">
        <h4>Support</h4>
        <ul>
          <li><a href="#">FAQ</a></li>
          <li><a href="#">Shipping Info</a></li>
          <li><a href="#">Returns</a></li>
          <li><a href="#">Track Order</a></li>
        </ul>
      </div>
      <div class="footer-col">
        <h4>Contact</h4>
        <ul>
          <li><a href="#">support@luxe.com</a></li>
          <li><a href="#">+1 (800) LUXE-123</a></li>
          <li><a href="#">Live Chat</a></li>
          <li><a href="#">Store Locator</a></li>
        </ul>
      </div>
    </div>
    <div class="footer-bottom">
      <p>© 2025 LUXE. All rights reserved.</p>
      <p>Privacy Policy · Terms of Service · Cookie Policy</p>
    </div>
  </footer>
</div>

<!-- ════════════════════════════════════════
     SHOP / PRODUCT LISTING PAGE
════════════════════════════════════════ -->
<div class="page" id="page-shop">
  <div class="page-hero">
    <div class="breadcrumb"><a onclick="showPage('home')">Home</a><span>›</span><span>Shop</span></div>
    <h1>All Products</h1>
    <p>Discover our complete collection of premium items</p>
  </div>
  <div class="shop-layout">
    <!-- Sidebar Filters -->
    <aside class="filters-sidebar">
      <div class="filter-group">
        <div class="filter-title">Categories</div>
        <div class="filter-options" id="category-filters"></div>
      </div>
      <div class="filter-group">
        <div class="filter-title">Price Range</div>
        <div class="price-range">
          <input type="range" id="price-range" min="0" max="2000" value="2000" oninput="filterProducts()"/>
          <div class="price-labels">
            <span>$0</span>
            <span id="price-max-label">$2000</span>
          </div>
        </div>
      </div>
      <div class="filter-group">
        <div class="filter-title">Rating</div>
        <div class="filter-options">
          <label class="filter-option"><input type="radio" name="rating" value="0" checked onchange="filterProducts()"/><label>All Ratings</label></label>
          <label class="filter-option"><input type="radio" name="rating" value="4" onchange="filterProducts()"/><label>4★ & above</label></label>
          <label class="filter-option"><input type="radio" name="rating" value="3" onchange="filterProducts()"/><label>3★ & above</label></label>
        </div>
      </div>
    </aside>
    <!-- Products Area -->
    <div>
      <div class="shop-header">
        <div class="result-count" id="result-count">Showing all products</div>
        <div class="shop-controls">
          <div class="search-box">
            <span>🔍</span>
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

  <!-- Footer repeated -->
  <footer style="margin-top:4rem">
    <div class="footer-bottom">
      <p>© 2025 LUXE. All rights reserved.</p>
      <button class="btn btn-outline btn-sm" onclick="showPage('home')">← Back to Home</button>
    </div>
  </footer>
</div>

<!-- ════════════════════════════════════════
     PRODUCT DETAIL PAGE
════════════════════════════════════════ -->
<div class="page" id="page-detail">
  <div class="page-hero" style="padding:2rem 5%">
    <div class="breadcrumb">
      <a onclick="showPage('home')">Home</a><span>›</span>
      <a onclick="showPage('shop')">Shop</a><span>›</span>
      <span id="detail-breadcrumb">Product</span>
    </div>
  </div>
  <div class="product-detail">
    <div class="detail-gallery">
      <div class="main-img" id="detail-main-img">👑</div>
      <div class="thumbs" id="detail-thumbs"></div>
    </div>
    <div class="detail-info">
      <div class="detail-cat" id="detail-cat">Category</div>
      <h1 class="detail-name" id="detail-name">Product Name</h1>
      <div class="detail-rating">
        <div class="stars" id="detail-stars">★★★★★</div>
        <span class="text-gray" style="font-size:0.85rem" id="detail-reviews">(0 reviews)</span>
        <span class="text-gold" style="font-size:0.82rem">In Stock</span>
      </div>
      <div class="detail-price">
        <span class="current" id="detail-price">$0.00</span>
        <span class="old" id="detail-old-price"></span>
      </div>
      <p class="detail-desc" id="detail-desc">Product description goes here.</p>
      <div class="detail-options">
        <div class="option-title">Color</div>
        <div class="color-options">
          <div class="color-dot active" style="background:#c9a84c" title="Gold"></div>
          <div class="color-dot" style="background:#888" title="Silver"></div>
          <div class="color-dot" style="background:#222" title="Black"></div>
          <div class="color-dot" style="background:#8B4513" title="Brown"></div>
        </div>
      </div>
      <div class="detail-options mt-2">
        <div class="option-title">Size</div>
        <div class="size-options">
          <button class="size-btn active">S</button>
          <button class="size-btn">M</button>
          <button class="size-btn">L</button>
          <button class="size-btn">XL</button>
        </div>
      </div>
      <div class="qty-row">
        <div class="qty-control">
          <button class="qty-btn" onclick="changeDetailQty(-1)">−</button>
          <input class="qty-val" id="detail-qty" value="1" readonly/>
          <button class="qty-btn" onclick="changeDetailQty(1)">+</button>
        </div>
        <span class="text-gray" style="font-size:0.85rem">Max 10 per order</span>
      </div>
      <div class="detail-btns">
        <button class="btn btn-gold w-full" onclick="addDetailToCart()" style="flex:2">🛒 Add to Cart</button>
        <button class="btn btn-outline" onclick="showPage('checkout')">Buy Now</button>
      </div>
    </div>
  </div>

  <!-- Reviews -->
  <div class="reviews">
    <div class="section-header" style="text-align:left;margin-bottom:2rem">
      <div class="section-tag">Reviews</div>
      <h2 class="section-title" style="font-size:1.4rem">Customer Reviews</h2>
    </div>
    <div id="reviews-list"></div>
  </div>
</div>

<!-- ════════════════════════════════════════
     CART PAGE
════════════════════════════════════════ -->
<div class="page" id="page-cart">
  <div class="page-hero">
    <div class="breadcrumb"><a onclick="showPage('home')">Home</a><span>›</span><span>Cart</span></div>
    <h1>Shopping Cart</h1>
  </div>
  <div class="cart-layout" id="cart-content"></div>
</div>

<!-- ════════════════════════════════════════
     CHECKOUT PAGE
════════════════════════════════════════ -->
<div class="page" id="page-checkout">
  <div class="page-hero">
    <div class="breadcrumb"><a onclick="showPage('home')">Home</a><span>›</span><a onclick="showPage('cart')">Cart</a><span>›</span><span>Checkout</span></div>
    <h1>Checkout</h1>
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
            <label>Email *</label>
            <input type="email" id="co-email" placeholder="john@email.com"/>
            <span class="error-msg">Please enter a valid email</span>
          </div>
          <div class="form-group" id="fg-phone">
            <label>Phone *</label>
            <input type="tel" id="phone" placeholder="+1 234 567 8900"/>
            <span class="error-msg">Please enter your phone number</span>
          </div>
          <div class="form-group full" id="fg-address">
            <label>Address *</label>
            <input type="text" id="address" placeholder="123 Main Street"/>
            <span class="error-msg">Please enter your address</span>
          </div>
          <div class="form-group" id="fg-city">
            <label>City *</label>
            <input type="text" id="city" placeholder="New York"/>
            <span class="error-msg">Please enter your city</span>
          </div>
          <div class="form-group" id="fg-zip">
            <label>ZIP Code *</label>
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
            </select>
          </div>
          <div class="form-group full">
            <label>Order Notes (Optional)</label>
            <textarea id="notes" placeholder="Special delivery instructions..."></textarea>
          </div>
        </div>
      </div>

      <!-- Payment -->
      <div class="checkout-form-box">
        <div class="form-section-title">Payment Method</div>
        <div class="payment-options">
          <div class="payment-option selected" onclick="selectPayment(this)">
            <input type="radio" name="payment" checked/> 💳 Credit / Debit Card
          </div>
          <div class="payment-option" onclick="selectPayment(this)">
            <input type="radio" name="payment"/> 📱 PayPal
          </div>
          <div class="payment-option" onclick="selectPayment(this)">
            <input type="radio" name="payment"/> 🏦 Bank Transfer
          </div>
          <div class="payment-option" onclick="selectPayment(this)">
            <input type="radio" name="payment"/> 💵 Cash on Delivery
          </div>
        </div>
      </div>

      <button class="btn btn-gold w-full" style="padding:1rem" onclick="placeOrder()">
        🔒 Place Order Securely
      </button>
    </div>

    <!-- Order Summary -->
    <div>
      <div class="cart-summary">
        <div class="summary-title">Order Summary</div>
        <div id="checkout-order-items"></div>
        <div id="checkout-summary-totals"></div>
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
      <div class="auth-logo">LUXE</div>
      <div class="auth-subtitle">Welcome back — sign in to your account</div>
      <form class="auth-form" onsubmit="handleLogin(event)">
        <div class="form-group" id="fg-login-email">
          <label>Email Address</label>
          <input type="email" id="login-email" placeholder="john@email.com"/>
          <span class="error-msg">Please enter a valid email</span>
        </div>
        <div class="form-group" id="fg-login-pass">
          <label>Password</label>
          <input type="password" id="login-pass" placeholder="Enter your password"/>
          <span class="error-msg">Password must be at least 6 characters</span>
        </div>
        <div style="display:flex;justify-content:flex-end">
          <a href="#" style="font-size:0.82rem;color:var(--gold)">Forgot password?</a>
        </div>
        <button type="submit" class="btn btn-gold w-full" style="padding:0.9rem">Sign In</button>
        <div class="auth-divider">or</div>
        <button type="button" class="btn btn-outline w-full" onclick="showPage('home')">Continue as Guest</button>
      </form>
      <div class="auth-footer">
        Don't have an account? <a onclick="showPage('register')">Register here</a>
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
      <div class="auth-logo">LUXE</div>
      <div class="auth-subtitle">Create your account today</div>
      <form class="auth-form" action="backend/add_user.php" method="POST">
        
         
        <div class="form-group" id="fg-reg-name">
          <label>Full Name</label>
          <input type="text" id="reg-name" placeholder="John Doe" name="fullname"/>
          <span class="error-msg">Please enter your full name</span>
        </div>
        <div class="form-group" id="fg-reg-email">
          <label>Email Address</label>
          <input type="email" id="reg-email" placeholder="john@email.com" name="email"/>
          <span class="error-msg">Please enter a valid email</span>
        </div>
        <div class="form-group" id="fg-reg-pass">
          <label>Password</label>
          <input type="password" id="reg-pass" placeholder="Min 6 characters" name="password"/>
          <span class="error-msg">Password must be at least 6 characters</span>
        </div>
        <div class="form-group" id="fg-reg-confirm">
          <label>Confirm Password</label>
          <input type="password" id="reg-confirm" placeholder="Repeat password"/>
          <span class="error-msg">Passwords do not match</span>
        </div>
        <button type="submit" class="btn btn-gold w-full" style="padding:0.9rem">Create Account</button>
        <div class="auth-divider">or</div>
        <button type="button" class="btn btn-outline w-full" onclick="showPage('home')">Continue as Guest</button>
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
          <span class="admin-nav-icon">👥</span> Users
        </div>
        <div class="admin-nav-item" onclick="showPage('home')">
          <span class="admin-nav-icon">🏠</span> Back to Store
        </div>
      </nav>
    </aside>

    <!-- Content -->
    <main class="admin-content">
      <!-- Dashboard Tab -->
      <div id="admin-dashboard">
        <div class="admin-top">
          <h1>Dashboard Overview</h1>
          <div style="color:var(--gray);font-size:0.85rem">Last updated: just now</div>
        </div>
        <div class="stats-cards">
          <div class="stat-card"><div class="stat-card-icon">📦</div><div class="stat-card-value" id="admin-total-products">12</div><div class="stat-card-label">Total Products</div><div class="stat-card-change">↑ 8% this month</div></div>
          <div class="stat-card"><div class="stat-card-icon">🛒</div><div class="stat-card-value">48</div><div class="stat-card-label">Total Orders</div><div class="stat-card-change">↑ 15% this month</div></div>
          <div class="stat-card"><div class="stat-card-icon">👥</div><div class="stat-card-value">1,284</div><div class="stat-card-label">Total Users</div><div class="stat-card-change">↑ 22% this month</div></div>
          <div class="stat-card"><div class="stat-card-icon">💰</div><div class="stat-card-value">$84K</div><div class="stat-card-label">Revenue</div><div class="stat-card-change">↑ 31% this month</div></div>
        </div>
        <div class="admin-section">
          <div class="admin-section-head"><h3>Recent Orders</h3><button class="btn btn-sm btn-outline" onclick="showAdminTab('orders',null)">View All</button></div>
          <table class="data-table">
            <thead><tr><th>Order ID</th><th>Customer</th><th>Amount</th><th>Status</th><th>Date</th></tr></thead>
            <tbody>
              <tr><td>#ORD-001</td><td>John Doe</td><td class="text-gold">$299.00</td><td><span class="status-badge status-delivered">Delivered</span></td><td>Mar 05, 2025</td></tr>
              <tr><td>#ORD-002</td><td>Jane Smith</td><td class="text-gold">$799.00</td><td><span class="status-badge status-shipped">Shipped</span></td><td>Mar 04, 2025</td></tr>
              <tr><td>#ORD-003</td><td>Mike Johnson</td><td class="text-gold">$149.00</td><td><span class="status-badge status-processing">Processing</span></td><td>Mar 04, 2025</td></tr>
              <tr><td>#ORD-004</td><td>Sara Lee</td><td class="text-gold">$1,299.00</td><td><span class="status-badge status-pending">Pending</span></td><td>Mar 03, 2025</td></tr>
            </tbody>
          </table>
        </div>
      </div>

      <!-- Products Tab -->
      <div id="admin-products" style="display:none">
        <div class="admin-top">
          <h1>Product Management</h1>
          <button class="btn btn-gold btn-sm" onclick="openAddProductModal()">+ Add Product</button>
        </div>
        <div class="admin-section">
          <div class="admin-section-head"><h3>All Products</h3><span class="text-gray" style="font-size:0.85rem" id="admin-product-count"></span></div>
          <table class="data-table" id="admin-products-table">
            <thead><tr><th>Icon</th><th>Name</th><th>Category</th><th>Price</th><th>Rating</th><th>Actions</th></tr></thead>
            <tbody id="admin-products-body"></tbody>
          </table>
        </div>
      </div>

      <!-- Orders Tab -->
      <div id="admin-orders" style="display:none">
        <div class="admin-top"><h1>Order Management</h1></div>
        <div class="admin-section">
          <div class="admin-section-head"><h3>All Orders</h3></div>
          <table class="data-table">
            <thead><tr><th>Order ID</th><th>Customer</th><th>Items</th><th>Amount</th><th>Status</th><th>Date</th><th>Actions</th></tr></thead>
            <tbody>
              <tr><td>#ORD-001</td><td>John Doe</td><td>3 items</td><td class="text-gold">$299.00</td><td><span class="status-badge status-delivered">Delivered</span></td><td>Mar 05</td><td><div class="table-actions"><button class="action-btn action-edit">View</button></div></td></tr>
              <tr><td>#ORD-002</td><td>Jane Smith</td><td>1 item</td><td class="text-gold">$799.00</td><td><span class="status-badge status-shipped">Shipped</span></td><td>Mar 04</td><td><div class="table-actions"><button class="action-btn action-edit">View</button></div></td></tr>
              <tr><td>#ORD-003</td><td>Mike Johnson</td><td>2 items</td><td class="text-gold">$149.00</td><td><span class="status-badge status-processing">Processing</span></td><td>Mar 04</td><td><div class="table-actions"><button class="action-btn action-edit">View</button></div></td></tr>
              <tr><td>#ORD-004</td><td>Sara Lee</td><td>1 item</td><td class="text-gold">$1,299.00</td><td><span class="status-badge status-pending">Pending</span></td><td>Mar 03</td><td><div class="table-actions"><button class="action-btn action-edit">View</button></div></td></tr>
              <tr><td>#ORD-005</td><td>Tom Brown</td><td>4 items</td><td class="text-gold">$450.00</td><td><span class="status-badge status-cancelled">Cancelled</span></td><td>Mar 02</td><td><div class="table-actions"><button class="action-btn action-edit">View</button></div></td></tr>
            </tbody>
          </table>
        </div>
      </div>

      <!-- Users Tab -->
      <div id="admin-users" style="display:none">
        <div class="admin-top"><h1>User Management</h1></div>
        <div class="admin-section">
          <div class="admin-section-head"><h3>Registered Users</h3></div>
          <table class="data-table">
            <thead><tr><th>Name</th><th>Email</th><th>Orders</th><th>Spent</th><th>Joined</th><th>Actions</th></tr></thead>
            <tbody>
              <tr><td>John Doe</td><td>john@email.com</td><td>12</td><td class="text-gold">$2,450</td><td>Jan 2025</td><td><div class="table-actions"><button class="action-btn action-edit">Edit</button><button class="action-btn action-del">Delete</button></div></td></tr>
              <tr><td>Jane Smith</td><td>jane@email.com</td><td>7</td><td class="text-gold">$1,299</td><td>Feb 2025</td><td><div class="table-actions"><button class="action-btn action-edit">Edit</button><button class="action-btn action-del">Delete</button></div></td></tr>
              <tr><td>Mike Johnson</td><td>mike@email.com</td><td>3</td><td class="text-gold">$588</td><td>Feb 2025</td><td><div class="table-actions"><button class="action-btn action-edit">Edit</button><button class="action-btn action-del">Delete</button></div></td></tr>
            </tbody>
          </table>
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
          <input type="text" id="ap-name" placeholder="Premium Watch"/>
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
          <textarea id="ap-desc" placeholder="Product description..."></textarea>
        </div>
        <div class="form-group">
          <label>Icon/Emoji</label>
          <input type="text" id="ap-icon" placeholder="⌚" maxlength="4"/>
        </div>
        <div class="form-group">
          <label>Old Price (optional)</label>
          <input type="number" id="ap-old-price" placeholder="399.00" step="0.01"/>
        </div>
      </div>
      <div style="margin-top:1.5rem;display:flex;gap:1rem;justify-content:flex-end">
        <button type="button" class="btn btn-outline" onclick="closeModal('add-product-modal')">Cancel</button>
        <button type="submit" class="btn btn-gold">Add Product</button>
      </div>
    </form>
  </div>
</div>

<!-- Order Success Modal -->
<div class="modal-overlay" id="order-success-modal">
  <div class="modal" style="text-align:center">
    <div style="font-size:4rem;margin-bottom:1rem">🎉</div>
    <h3 style="font-size:1.4rem;margin-bottom:0.75rem">Order Placed Successfully!</h3>
    <p style="color:var(--gray);margin-bottom:2rem">Thank you for your purchase. Your order will be delivered in 3–5 business days.</p>
    <div style="background:var(--dark2);border-radius:10px;padding:1rem;margin-bottom:1.5rem;font-size:0.88rem">
      <div style="color:var(--gray)">Order ID</div>
      <div style="color:var(--gold);font-size:1.1rem;font-weight:700" id="order-id-display">#ORD-XXX</div>
    </div>
    <button class="btn btn-gold w-full" onclick="closeModal('order-success-modal');showPage('home')">Continue Shopping</button>
  </div>
</div>

<!-- Toast Container -->
<div class="toast-container" id="toast-container"></div>

<!-- JAVASCRIPT -->
<script>
/* ────────────────────────────────────────
   PRODUCT DATA
──────────────────────────────────────── */
const products = [
  {id:1, name:'Luminara Gold Watch',        cat:'Watches',     price:1299, oldPrice:1799, rating:4.9, reviews:284, icon:'⌚', badge:'Best Seller', desc:'Exquisite handcrafted timepiece featuring 18k gold-plated case, Swiss movement, and sapphire crystal glass. Water resistant to 50m.'},
  {id:2, name:'AirPods Pro Max',             cat:'Electronics', price:549,  oldPrice:649,  rating:4.8, reviews:1203,icon:'🎧', badge:'Hot',         desc:'Industry-leading noise cancellation with Adaptive Audio, Personalized Spatial Audio, and stunning sound quality.'},
  {id:3, name:'Diamond Solitaire Ring',      cat:'Jewelry',     price:2499, oldPrice:null, rating:5.0, reviews:89,  icon:'💍', badge:'Premium',     desc:'Elegant solitaire ring featuring a 1-carat certified diamond in a platinum six-prong setting.'},
  {id:4, name:'Silk Evening Dress',          cat:'Fashion',     price:349,  oldPrice:499,  rating:4.7, reviews:156, icon:'👗', badge:'Sale',        desc:'Luxurious pure silk evening gown with hand-sewn embellishments. Available in multiple colors.'},
  {id:5, name:'Smart Home Hub Pro',          cat:'Electronics', price:299,  oldPrice:399,  rating:4.6, reviews:412, icon:'🏠', badge:null,          desc:'Control all your smart devices from one elegant hub. Compatible with Alexa, Google Home, and HomeKit.'},
  {id:6, name:'Rose Gold Necklace',          cat:'Jewelry',     price:799,  oldPrice:null, rating:4.8, reviews:203, icon:'📿', badge:'New',         desc:'18k rose gold chain featuring a hand-set diamond pendant. Comes in a luxury gift box.'},
  {id:7, name:'Leather Tote Bag',            cat:'Fashion',     price:459,  oldPrice:599,  rating:4.5, reviews:318, icon:'👜', badge:'Sale',        desc:'Full-grain Italian leather tote with brass hardware. Fits 15" laptop. Hand-stitched by artisans.'},
  {id:8, name:'Espresso Machine Deluxe',     cat:'Home',        price:699,  oldPrice:899,  rating:4.7, reviews:521, icon:'☕', badge:null,          desc:'Professional-grade espresso machine with 15-bar pressure, built-in grinder, and milk frother.'},
  {id:9, name:'Vitamin C Serum Gold',        cat:'Beauty',      price:89,   oldPrice:119,  rating:4.8, reviews:944, icon:'✨', badge:'Bestseller',  desc:'Concentrated 20% Vitamin C formula with hyaluronic acid and ferulic acid for radiant, youthful skin.'},
  {id:10,name:'Carbon Fiber Sunglasses',     cat:'Fashion',     price:289,  oldPrice:null, rating:4.6, reviews:167, icon:'🕶️', badge:'New',        desc:'Ultra-lightweight carbon fiber frames with polarized UV400 lenses and titanium hinges.'},
  {id:11,name:'Smart Fitness Ring',          cat:'Electronics', price:349,  oldPrice:449,  rating:4.4, reviews:289, icon:'💪', badge:null,          desc:'24/7 health monitoring including sleep, heart rate, SpO2, and activity tracking in a slim ring form factor.'},
  {id:12,name:'Cashmere Scarf',              cat:'Fashion',     price:199,  oldPrice:279,  rating:4.9, reviews:412, icon:'🧣', badge:'Sale',        desc:'Pure Scottish cashmere scarf, 100% ethically sourced. Exceptionally soft with timeless plaid pattern.'},
];

const reviews = [
  {name:'Alexandra M.',rating:5,text:'Absolutely stunning quality. The packaging alone was impressive, and the product exceeded my expectations. Will definitely purchase again.',date:'Feb 28, 2025'},
  {name:'James T.',    rating:4,text:'Great product, fast shipping. Exactly as described. The craftsmanship is exceptional for the price point.',date:'Feb 20, 2025'},
  {name:'Sofia R.',    rating:5,text:'I bought this as a gift and the recipient was overjoyed. Beautiful, high-quality, and arrived perfectly packaged.',date:'Feb 15, 2025'},
];

/* ────────────────────────────────────────
   CART STATE
──────────────────────────────────────── */
let cart = [];
let currentDetailProduct = null;
let filteredProducts = [...products];
let selectedCategoryFilter = null;

/* ────────────────────────────────────────
   PAGE NAVIGATION
──────────────────────────────────────── */
window.showPage = function(id) {
  document.querySelectorAll('.page').forEach(p => p.classList.remove('active'));
  document.getElementById('page-' + id).classList.add('active');
  window.scrollTo({top:0, behavior:'smooth'});

  // Render page-specific content
  if (id === 'home')     renderFeaturedProducts();
  if (id === 'shop')     renderShopProducts();
  if (id === 'cart')     renderCart();
  if (id === 'checkout') renderCheckoutSummary();
  if (id === 'admin')    renderAdminProducts();
  if (id === 'detail')   renderDetailPage();
}

/* ────────────────────────────────────────
   HAMBURGER MENU
──────────────────────────────────────── */
window.toggleMenu = function() {
  document.getElementById('mobile-menu').classList.toggle('open');
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
    <div class="filter-option">
      <input type="checkbox" id="cat-${cat}" value="${cat}" onchange="filterProducts()"/>
      <label for="cat-${cat}">${cat} (${products.filter(p=>p.cat===cat).length})</label>
    </div>
  `).join('');

  // If category was pre-selected from home page
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

window.filterProducts = function() {
  const search = document.getElementById('search-input')?.value.toLowerCase() || '';
  const priceMax = parseInt(document.getElementById('price-range')?.value || 2000);
  const ratingMin = parseFloat(document.querySelector('input[name="rating"]:checked')?.value || 0);
  const sort = document.getElementById('sort-select')?.value || 'default';
  const selectedCats = [...document.querySelectorAll('#category-filters input:checked')].map(i => i.value);

  document.getElementById('price-max-label').textContent = '$' + priceMax;

  let result = products.filter(p => {
    const matchSearch = p.name.toLowerCase().includes(search) || p.cat.toLowerCase().includes(search);
    const matchPrice  = p.price <= priceMax;
    const matchRating = p.rating >= ratingMin;
    const matchCat    = selectedCats.length === 0 || selectedCats.includes(p.cat);
    return matchSearch && matchPrice && matchRating && matchCat;
  });

  // Sort
  if (sort === 'price-low')  result.sort((a,b) => a.price - b.price);
  if (sort === 'price-high') result.sort((a,b) => b.price - a.price);
  if (sort === 'rating')     result.sort((a,b) => b.rating - a.rating);
  if (sort === 'name')       result.sort((a,b) => a.name.localeCompare(b.name));

  document.getElementById('result-count').textContent = `Showing ${result.length} of ${products.length} products`;
  document.getElementById('shop-products').innerHTML = result.length
    ? result.map(p => productCardHTML(p)).join('')
    : '<div style="color:var(--gray);padding:3rem;text-align:center;grid-column:1/-1">No products found. Try adjusting your filters.</div>';
}

/* ────────────────────────────────────────
   PRODUCT CARD HTML
──────────────────────────────────────── */
window.productCardHTML = function(p) {
  const stars = '★'.repeat(Math.floor(p.rating)) + (p.rating % 1 ? '½' : '');
  return `
    <div class="product-card">
      ${p.badge ? `<div class="product-badge ${p.badge==='Sale'?'sale':''}">${p.badge}</div>` : ''}
      <div class="product-img">
        <span>${p.icon}</span>
        <div class="product-actions">
          <button class="product-action-btn" onclick="openDetail(${p.id})">View Details</button>
          <button class="product-action-btn" onclick="addToCart(${p.id})">Add to Cart</button>
        </div>
      </div>
      <div class="product-body">
        <div class="product-cat">${p.cat}</div>
        <div class="product-name">${p.name}</div>
        <div class="product-rating">
          <div class="stars">${stars}</div>
          <span class="rating-count">(${p.reviews})</span>
        </div>
        <div class="product-price">
          <span class="price-current">$${p.price.toLocaleString()}</span>
          ${p.oldPrice ? `<span class="price-old">$${p.oldPrice.toLocaleString()}</span>` : ''}
        </div>
      </div>
      <div class="product-footer">
        <button class="btn btn-gold w-full" onclick="addToCart(${p.id})">Add to Cart</button>
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
  document.getElementById('detail-main-img').textContent = p.icon;
  document.getElementById('detail-stars').textContent = '★'.repeat(Math.floor(p.rating));
  document.getElementById('detail-reviews').textContent = `(${p.reviews} reviews)`;
  document.getElementById('detail-qty').value = 1;

  const old = document.getElementById('detail-old-price');
  old.textContent = p.oldPrice ? '$' + p.oldPrice.toLocaleString() : '';

  // Thumbs
  const thumbs = [p.icon, '🔍', '📷', '🖼️'];
  document.getElementById('detail-thumbs').innerHTML = thumbs.map((t,i) => `
    <div class="thumb ${i===0?'active':''}" onclick="setThumb(this,'${t}')">${t}</div>
  `).join('');

  // Reviews
  document.getElementById('reviews-list').innerHTML = reviews.map(r => `
    <div class="review-card">
      <div class="review-header">
        <div>
          <div class="reviewer">${r.name}</div>
          <div class="stars" style="font-size:0.85rem">${'★'.repeat(r.rating)}</div>
        </div>
        <div class="review-date">${r.date}</div>
      </div>
      <p class="review-text">${r.text}</p>
    </div>
  `).join('');
}

window.setThumb = function(el, icon) {
  document.querySelectorAll('.thumb').forEach(t => t.classList.remove('active'));
  el.classList.add('active');
  document.getElementById('detail-main-img').textContent = icon;
}

window.changeDetailQty = function(delta) {
  const input = document.getElementById('detail-qty');
  const val = Math.max(1, Math.min(10, parseInt(input.value) + delta));
  input.value = val;
}

window.addDetailToCart = function() {
  const qty = parseInt(document.getElementById('detail-qty').value);
  for (let i = 0; i < qty; i++) addToCart(currentDetailProduct.id);
  if (qty > 1) {
    // already called multiple times
  }
  showToast(`${currentDetailProduct.name} added to cart!`, 'success');
}

// Color & Size selection
document.querySelectorAll('.color-dot').forEach(d => {
  d.addEventListener('click', () => {
    document.querySelectorAll('.color-dot').forEach(x => x.classList.remove('active'));
    d.classList.add('active');
  });
});
document.querySelectorAll('.size-btn').forEach(b => {
  b.addEventListener('click', () => {
    document.querySelectorAll('.size-btn').forEach(x => x.classList.remove('active'));
    b.classList.add('active');
  });
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
  showToast(product.name + ' added to cart!', 'success');
}

window.removeFromCart = function(id) {
  cart = cart.filter(i => i.id !== id);
  updateCartCount();
  renderCart();
  showToast('Item removed from cart', 'info');
}

window.updateQty = function(id, delta) {
  const item = cart.find(i => i.id === id);
  if (!item) return;
  item.qty = Math.max(1, item.qty + delta);
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
      <div style="grid-column:1/-1">
        <div class="empty-cart">
          <div class="icon">🛒</div>
          <h3>Your cart is empty</h3>
          <p>Looks like you haven't added anything yet.</p>
          <button class="btn btn-gold" onclick="showPage('shop')">Start Shopping</button>
        </div>
      </div>`;
    return;
  }

  const {subtotal, shipping, tax, total} = getCartTotals();

  container.innerHTML = `
    <div>
      <div class="cart-table">
        <div class="cart-table-head">
          <span>Product</span>
          <span class="hide-mobile">Price</span>
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
                <div class="cart-product-cat">${item.cat}</div>
              </div>
            </div>
            <div class="cart-price hide-mobile">$${item.price.toLocaleString()}</div>
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
      <div style="margin-top:1rem;display:flex;justify-content:space-between;flex-wrap:wrap;gap:1rem">
        <button class="btn btn-outline" onclick="showPage('shop')">← Continue Shopping</button>
        <button class="btn btn-red btn-sm" onclick="cart=[];updateCartCount();renderCart();showToast('Cart cleared','info')">Clear Cart</button>
      </div>
    </div>

    <div>
      <div class="cart-summary">
        <div class="summary-title">Order Summary</div>
        <div class="summary-row"><span class="label">Subtotal</span><span>$${subtotal.toFixed(2)}</span></div>
        <div class="summary-row"><span class="label">Shipping</span><span>${shipping===0?'<span style="color:var(--green)">Free</span>':'$'+shipping.toFixed(2)}</span></div>
        <div class="summary-row"><span class="label">Tax (8%)</span><span>$${tax.toFixed(2)}</span></div>
        <div class="summary-row total"><span class="label">Total</span><span class="value">$${total.toFixed(2)}</span></div>
        <div class="promo-input">
          <input type="text" placeholder="Promo code..." id="promo-input"/>
          <button class="btn btn-dark btn-sm" onclick="applyPromo()">Apply</button>
        </div>
        <button class="btn btn-gold w-full" style="padding:0.9rem" onclick="showPage('checkout')">Proceed to Checkout →</button>
      </div>
    </div>
  `;
}

window.applyPromo = function() {
  const code = document.getElementById('promo-input')?.value.trim().toUpperCase();
  if (code === 'LUXE10') showToast('10% discount applied!', 'success');
  else showToast('Invalid promo code', 'error');
}

/* ────────────────────────────────────────
   RENDER CHECKOUT SUMMARY
──────────────────────────────────────── */
window.renderCheckoutSummary = function() {
  const {subtotal, shipping, tax, total} = getCartTotals();

  document.getElementById('checkout-order-items').innerHTML = cart.length === 0
    ? '<p style="color:var(--gray);font-size:0.88rem">No items in cart</p>'
    : cart.map(item => `
        <div class="order-item">
          <div class="order-item-img">${item.icon}</div>
          <div class="order-item-info">
            <div>${item.name}</div>
            <p>Qty: ${item.qty} × $${item.price.toLocaleString()}</p>
          </div>
          <div class="order-item-price">$${(item.price * item.qty).toLocaleString()}</div>
        </div>
      `).join('');

  document.getElementById('checkout-summary-totals').innerHTML = `
    <div class="summary-row"><span class="label">Subtotal</span><span>$${subtotal.toFixed(2)}</span></div>
    <div class="summary-row"><span class="label">Shipping</span><span>${shipping===0?'Free':'$'+shipping.toFixed(2)}</span></div>
    <div class="summary-row"><span class="label">Tax</span><span>$${tax.toFixed(2)}</span></div>
    <div class="summary-row total"><span class="label">Total</span><span class="value">$${total.toFixed(2)}</span></div>
  `;
}

/* ────────────────────────────────────────
   CHECKOUT FORM VALIDATION
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
    validateField('fname',   v => v.trim().length >= 2),
    validateField('lname',   v => v.trim().length >= 2),
    validateField('email',   v => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v)),
    validateField('phone',   v => v.trim().length >= 7),
    validateField('address', v => v.trim().length >= 5),
    validateField('city',    v => v.trim().length >= 2),
    validateField('zip',     v => v.trim().length >= 3),
  ];

  if (checks.every(Boolean)) {
    const orderId = '#ORD-' + Math.floor(Math.random() * 9000 + 1000);
    document.getElementById('order-id-display').textContent = orderId;
    cart = [];
    updateCartCount();
    openModal('order-success-modal');
  } else {
    showToast('Please fill in all required fields', 'error');
    // Scroll to first error
    const firstInvalid = document.querySelector('.form-group.invalid');
    if (firstInvalid) firstInvalid.scrollIntoView({behavior:'smooth', block:'center'});
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
   AUTH FORMS VALIDATION
──────────────────────────────────────── */
window.handleLogin = function(e) {
  e.preventDefault();
  const emailOk = validateField('login-email', v => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v));
  const passOk  = validateField('login-pass',  v => v.length >= 6);
  if (emailOk && passOk) {
    showToast('Welcome back! Logged in successfully.', 'success');
    showPage('home');
  }
}

window.handleRegister = function(e) {
  e.preventDefault();
  const nameOk    = validateField('reg-name',    v => v.trim().length >= 2);
  const emailOk   = validateField('reg-email',   v => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v));
  const passOk    = validateField('reg-pass',    v => v.length >= 6);
  const confirmOk = validateField('reg-confirm', v => v === document.getElementById('reg-pass').value && v.length > 0);
  if (nameOk && emailOk && passOk && confirmOk) {
    showToast('Account created! Welcome to LUXE.', 'success');
    showPage('home');
  }
}

/* ────────────────────────────────────────
   ADMIN PANEL
──────────────────────────────────────── */
window.showAdminTab = function(tab, navEl) {
  ['dashboard','products','orders','users'].forEach(t => {
    document.getElementById('admin-' + t).style.display = t === tab ? 'block' : 'none';
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
      <td style="font-size:1.5rem">${p.icon}</td>
      <td>${p.name}</td>
      <td><span style="color:var(--gold);font-size:0.8rem">${p.cat}</span></td>
      <td class="text-gold">$${p.price.toLocaleString()}</td>
      <td>${'★'.repeat(Math.floor(p.rating))} ${p.rating}</td>
      <td>
        <div class="table-actions">
          <button class="action-btn action-edit" onclick="showToast('Edit product: ${p.name}','info')">Edit</button>
          <button class="action-btn action-del"  onclick="deleteAdminProduct(${p.id})">Delete</button>
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
    showToast(name + ' deleted', 'error');
  }
}

window.openAddProductModal = function() {
  openModal('add-product-modal');
}

window.handleAddProduct = function(e) {
  e.preventDefault();
  const name  = document.getElementById('ap-name').value.trim();
  const price = parseFloat(document.getElementById('ap-price').value);
  const cat   = document.getElementById('ap-category').value;
  const desc  = document.getElementById('ap-desc').value;
  const icon  = document.getElementById('ap-icon').value || '📦';
  const old   = parseFloat(document.getElementById('ap-old-price').value) || null;

  if (!name || !price) { showToast('Please fill in required fields', 'error'); return; }

  const newProduct = {
    id: products.length + 100,
    name, cat, price, oldPrice: old, rating: 0,
    reviews: 0, icon, badge: 'New', desc
  };
  products.push(newProduct);
  closeModal('add-product-modal');
  renderAdminProducts();
  showToast(name + ' added successfully!', 'success');

  // Reset form
  ['ap-name','ap-price','ap-desc','ap-icon','ap-old-price'].forEach(id => {
    document.getElementById(id).value = '';
  });
}

/* ────────────────────────────────────────
   MODALS
──────────────────────────────────────── */
window.openModal = function(id) {
  document.getElementById(id).classList.add('open');
}

window.closeModal = function(id) {
  document.getElementById(id).classList.remove('open');
}

// Close modal on overlay click
document.querySelectorAll('.modal-overlay').forEach(overlay => {
  overlay.addEventListener('click', function(e) {
    if (e.target === this) this.classList.remove('open');
  });
});

/* ────────────────────────────────────────
   TOAST NOTIFICATIONS
──────────────────────────────────────── */
window.showToast = function(msg, type = 'info') {
  const icons = {success:'✅', error:'❌', info:'ℹ️'};
  const container = document.getElementById('toast-container');
  const toast = document.createElement('div');
  toast.className = `toast ${type}`;
  toast.innerHTML = `<span class="toast-icon">${icons[type]}</span><span class="toast-msg">${msg}</span>`;
  container.appendChild(toast);
  setTimeout(() => {
    toast.style.animation = 'slideIn 0.3s ease reverse';
    setTimeout(() => toast.remove(), 300);
  }, 3000);
}

/* ────────────────────────────────────────
   INIT
──────────────────────────────────────── */
/* ────────────────────────────────────────
   INIT — wire all navigation safely
──────────────────────────────────────── */
document.addEventListener('DOMContentLoaded', function() {
  // Wire nav buttons via data-page attribute
  document.querySelectorAll('[data-page]').forEach(function(el) {
    el.style.cursor = 'pointer';
    el.addEventListener('click', function() {
      var page = this.getAttribute('data-page');
      if (page) showPage(page);
      document.getElementById('mobile-menu').classList.remove('open');
    });
  });

  // Hamburger
  var ham = document.getElementById('hamburger-btn');
  if (ham) {
    ham.addEventListener('click', function() {
      document.getElementById('mobile-menu').classList.toggle('open');
    });
  }

  renderFeaturedProducts();
  updateCartCount();
});
</script>
</body>
</html>