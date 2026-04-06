<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();

include 'configuration/database_connection.php';

$result = mysqli_query($conn, "SELECT * FROM product_detail ORDER BY id ASC");

if (!$result) {
    die("Database error: " . mysqli_error($conn));
}

$all_products = [];
while ($row = mysqli_fetch_assoc($result)) {
    $all_products[] = $row;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>LUXE — Curated Luxury</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,100;0,9..144,400;0,9..144,700;1,9..144,300;1,9..144,600&family=Epilogue:wght@200;300;400;500;600&display=swap" rel="stylesheet">
<style>
:root {
  --ink:    #08090d;
  --ink2:   #0e0f15;
  --ink3:   #14151e;
  --panel:  #191a24;
  --card:   #1d1e2a;
  --glass:  rgba(255,255,255,0.04);
  --rim:    rgba(255,255,255,0.08);
  --rim2:   rgba(255,255,255,0.14);
  --amber:  #d4a853;
  --amber2: #f0c876;
  --amber3: rgba(212,168,83,0.12);
  --snow:   #edeae3;
  --ash:    #9a97a0;
  --fog:    #5c5a66;
  --rose:   #c0596a;
  --teal:   #3fa89a;
  --ff-d:   'Fraunces', serif;
  --ff-s:   'Epilogue', sans-serif;
  --nav:    72px;
  --ease:   cubic-bezier(.4,0,.2,1);
}
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
html{scroll-behavior:smooth}
body{font-family:var(--ff-s);background:var(--ink);color:var(--snow);line-height:1.6;overflow-x:hidden;font-weight:300}
a{text-decoration:none;color:inherit}
button{cursor:pointer;border:none;outline:none;font-family:inherit}
img{max-width:100%;display:block}
ul{list-style:none}
input,select,textarea{font-family:inherit;outline:none}

/* ─── scrollbar ─── */
::-webkit-scrollbar{width:4px}
::-webkit-scrollbar-track{background:var(--ink)}
::-webkit-scrollbar-thumb{background:var(--amber);border-radius:2px}

/* ─── grain overlay ─── */
body::after{content:'';position:fixed;inset:0;z-index:9999;pointer-events:none;
  background-image:url("data:image/svg+xml,%3Csvg viewBox='0 0 300 300' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.85' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.035'/%3E%3C/svg%3E");
  opacity:0.5}

/* ═══════════════════════════════
   PAGE SYSTEM
═══════════════════════════════ */
.page{display:none}
.page.active{display:block}

/* ═══════════════════════════════
   NAVBAR
═══════════════════════════════ */
.navbar{
  position:sticky;top:0;z-index:200;
  height:var(--nav);
  background:rgba(8,9,13,0.88);
  backdrop-filter:blur(20px);
  border-bottom:1px solid var(--rim);
  display:flex;align-items:center;
  justify-content:space-between;
  padding:0 5%;gap:2rem;
}
.nav-logo{
  font-family:var(--ff-d);
  font-size:1.55rem;font-weight:700;
  letter-spacing:0.28em;text-transform:uppercase;
  color:var(--snow);flex-shrink:0;cursor:pointer;
  display:flex;align-items:center;gap:0.5rem;
}
.nav-logo-dot{
  width:7px;height:7px;background:var(--amber);border-radius:50%;
  animation:blink 3s ease-in-out infinite;
}
@keyframes blink{0%,100%{opacity:1}50%{opacity:0.3}}
.nav-links{display:flex;align-items:center;gap:0.25rem;flex:1;justify-content:center}
.nav-link{
  padding:0.5rem 1.2rem;
  font-size:0.76rem;letter-spacing:0.14em;text-transform:uppercase;
  font-weight:500;color:var(--ash);cursor:pointer;
  border-radius:4px;transition:all 0.25s var(--ease);
  border:1px solid transparent;
}
.nav-link:hover{color:var(--snow);background:var(--glass)}
.nav-link.active{color:var(--amber);border-color:var(--rim2);background:var(--amber3)}
.nav-search{
  display:flex;align-items:center;gap:0.5rem;
  background:var(--ink3);border:1px solid var(--rim);
  border-radius:6px;padding:0.45rem 1rem;
  transition:all 0.25s var(--ease);
}
.nav-search:focus-within{border-color:var(--amber);box-shadow:0 0 0 3px rgba(212,168,83,0.1)}
.nav-search input{
  background:none;border:none;color:var(--snow);
  font-size:0.82rem;width:170px;
}
.nav-search input::placeholder{color:var(--fog)}
.nav-actions{display:flex;align-items:center;gap:0.4rem}
.nav-btn{
  position:relative;width:38px;height:38px;
  background:var(--ink3);border:1px solid var(--rim);
  border-radius:6px;display:flex;align-items:center;
  justify-content:center;color:var(--ash);font-size:0.95rem;
  transition:all 0.25s var(--ease);
}
.nav-btn:hover{border-color:var(--amber);color:var(--amber)}
.nav-badge{
  position:absolute;top:-5px;right:-5px;
  background:var(--amber);color:#000;
  font-size:0.56rem;font-weight:700;
  width:16px;height:16px;border-radius:50%;
  display:flex;align-items:center;justify-content:center;
}
.hamburger{display:none;flex-direction:column;gap:5px;background:none;padding:6px}
.hamburger span{width:20px;height:1.5px;background:var(--snow);border-radius:2px;transition:all 0.25s var(--ease)}

/* ═══════════════════════════════
   MOBILE NAV
═══════════════════════════════ */
.mobile-nav{
  display:none;position:fixed;inset:0;z-index:300;
  background:rgba(8,9,13,0.97);
  flex-direction:column;align-items:center;justify-content:center;gap:2.5rem;
}
.mobile-nav.open{display:flex}
.mobile-nav a{
  font-family:var(--ff-d);font-size:2.8rem;font-weight:300;
  font-style:italic;color:var(--ash);transition:all 0.25s var(--ease);cursor:pointer;
}
.mobile-nav a:hover{color:var(--amber)}
.mnav-close{position:absolute;top:1.5rem;right:5%;background:none;color:var(--fog);font-size:1.5rem}

/* ═══════════════════════════════
   BUTTONS
═══════════════════════════════ */
.btn{
  display:inline-flex;align-items:center;justify-content:center;gap:0.5rem;
  padding:0.75rem 2rem;font-size:0.76rem;letter-spacing:0.13em;
  text-transform:uppercase;font-weight:500;
  border-radius:4px;transition:all 0.28s var(--ease);
  font-family:var(--ff-s);cursor:pointer;
}
.btn-amber{background:var(--amber);color:#000}
.btn-amber:hover{background:var(--amber2);transform:translateY(-2px);box-shadow:0 10px 28px rgba(212,168,83,0.3)}
.btn-ghost{background:transparent;color:var(--snow);border:1px solid var(--rim2)}
.btn-ghost:hover{border-color:var(--amber);color:var(--amber)}
.btn-sm{padding:0.52rem 1.3rem;font-size:0.72rem}
.btn-full{width:100%}

/* ═══════════════════════════════
   ╔══════════════════════╗
   ║   HOME PAGE          ║
   ╚══════════════════════╝
═══════════════════════════════ */

/* ─── HERO ─── */
.hero{
  min-height:calc(92vh - var(--nav));
  display:grid;grid-template-columns:1fr 1fr;
  position:relative;overflow:hidden;
}
.hero-left{
  display:flex;flex-direction:column;justify-content:center;
  padding:7rem 6% 7rem 8%;
  position:relative;z-index:2;
}
.hero-right{position:relative;overflow:hidden;background:var(--ink2)}
.hero-right-img{
  width:100%;height:100%;object-fit:cover;
  filter:brightness(0.6) contrast(1.1);
  transition:transform 8s ease;
}
.hero-right:hover .hero-right-img{transform:scale(1.04)}
.hero-right-vignette{
  position:absolute;inset:0;
  background:linear-gradient(to right, var(--ink) 0%, transparent 40%),
             linear-gradient(to top, rgba(8,9,13,0.7) 0%, transparent 40%);
}
.hero-tag{
  display:inline-flex;align-items:center;gap:0.6rem;
  font-size:0.7rem;letter-spacing:0.26em;text-transform:uppercase;
  color:var(--amber);margin-bottom:2rem;font-weight:500;
}
.hero-tag-line{width:28px;height:1px;background:var(--amber)}
.hero h1{
  font-family:var(--ff-d);
  font-size:clamp(3.2rem,6vw,6rem);
  font-weight:700;line-height:0.97;
  color:var(--snow);margin-bottom:1.8rem;
  letter-spacing:-0.01em;
}
.hero h1 em{
  font-style:italic;font-weight:300;
  color:transparent;
  -webkit-text-stroke:1px var(--amber);
}
.hero-desc{
  color:var(--ash);font-size:0.93rem;
  max-width:360px;line-height:1.85;
  margin-bottom:2.8rem;
}
.hero-btns{display:flex;gap:1rem;flex-wrap:wrap}
.hero-stats{
  display:flex;gap:2.5rem;margin-top:3.5rem;
  padding-top:2rem;border-top:1px solid var(--rim);
}
.hero-stat-val{
  font-family:var(--ff-d);font-size:1.6rem;font-weight:700;
  color:var(--amber);display:block;
}
.hero-stat-lbl{font-size:0.7rem;letter-spacing:0.12em;text-transform:uppercase;color:var(--fog)}
.hero-float-card{
  position:absolute;bottom:2.5rem;right:2.5rem;
  background:rgba(14,15,21,0.9);
  border:1px solid var(--rim2);border-radius:12px;
  padding:1.2rem 1.5rem;backdrop-filter:blur(16px);
  animation:floatUp 1s var(--ease) 0.5s both;z-index:3;
}
@keyframes floatUp{from{opacity:0;transform:translateY(20px)}to{opacity:1;transform:translateY(0)}}
.hfc-label{font-size:0.66rem;letter-spacing:0.18em;text-transform:uppercase;color:var(--fog);margin-bottom:0.4rem}
.hfc-name{font-family:var(--ff-d);font-size:1rem;font-weight:600;margin-bottom:0.25rem}
.hfc-price{color:var(--amber);font-size:0.92rem;font-weight:500}
.hfc-badge{
  display:inline-flex;align-items:center;gap:0.4rem;margin-top:0.6rem;
  background:rgba(212,168,83,0.15);border:1px solid rgba(212,168,83,0.3);
  border-radius:20px;padding:0.2rem 0.75rem;
  font-size:0.65rem;font-weight:600;letter-spacing:0.08em;color:var(--amber);
}
.hfc-dot{width:5px;height:5px;background:var(--amber);border-radius:50%;animation:blink 2s infinite}

/* ─── TICKER ─── */
.ticker{background:var(--amber);overflow:hidden;padding:0.55rem 0}
.ticker-track{display:inline-flex;gap:4rem;animation:ticker 22s linear infinite;white-space:nowrap}
@keyframes ticker{from{transform:translateX(0)}to{transform:translateX(-50%)}}
.ticker-item{
  font-size:0.7rem;letter-spacing:0.2em;text-transform:uppercase;
  color:#000;font-weight:600;display:inline-flex;align-items:center;gap:1rem;
}
.ticker-item::after{content:'◆';font-size:0.45rem;opacity:0.6}

/* ─── CATEGORY GRID ─── */
.section{padding:6rem 8%}
.section-dark{background:var(--ink2)}
.eyebrow{
  display:flex;align-items:center;gap:0.7rem;
  font-size:0.7rem;letter-spacing:0.26em;text-transform:uppercase;
  color:var(--amber);margin-bottom:0.7rem;font-weight:500;
}
.eyebrow::before{content:'';width:22px;height:1px;background:var(--amber)}
.section-title{
  font-family:var(--ff-d);
  font-size:clamp(1.8rem,3.5vw,3rem);
  font-weight:700;color:var(--snow);line-height:1.05;
}
.cat-grid{
  display:grid;
  grid-template-columns:repeat(auto-fill,minmax(130px,1fr));
  gap:0.85rem;margin-top:3rem;
}
.cat-card{
  background:var(--panel);border:1px solid var(--rim);
  border-radius:10px;padding:1.8rem 1rem;
  text-align:center;cursor:pointer;transition:all 0.28s var(--ease);
  position:relative;overflow:hidden;
}
.cat-card::after{
  content:'';position:absolute;bottom:0;left:0;right:0;
  height:2px;background:var(--amber);transform:scaleX(0);transition:transform 0.3s var(--ease);
}
.cat-card:hover{border-color:rgba(212,168,83,0.35);transform:translateY(-4px)}
.cat-card:hover::after{transform:scaleX(1)}
.cat-icon{font-size:1.8rem;margin-bottom:0.7rem;display:block}
.cat-name{font-size:0.76rem;letter-spacing:0.1em;text-transform:uppercase;color:var(--snow);font-weight:500}
.cat-num{font-size:0.66rem;color:var(--fog);margin-top:0.3rem}

/* ─── FEATURES STRIP ─── */
.features-strip{
  display:grid;grid-template-columns:repeat(4,1fr);
  gap:0;border-top:1px solid var(--rim);border-bottom:1px solid var(--rim);
  background:var(--ink2);
}
.feature-item{
  padding:2.5rem 2rem;text-align:center;
  border-right:1px solid var(--rim);
}
.feature-item:last-child{border-right:none}
.feat-icon{font-size:1.4rem;margin-bottom:0.75rem;display:block;color:var(--amber)}
.feat-title{font-size:0.8rem;font-weight:600;letter-spacing:0.08em;text-transform:uppercase;margin-bottom:0.3rem}
.feat-desc{font-size:0.78rem;color:var(--ash);line-height:1.6}

/* ─── EDITORIAL BLOCK ─── */
.editorial{
  display:grid;grid-template-columns:1.2fr 1fr;
  min-height:520px;
  background:var(--ink2);
  border-top:1px solid var(--rim);border-bottom:1px solid var(--rim);
}
.ed-img{position:relative;overflow:hidden}
.ed-img img{width:100%;height:100%;object-fit:cover;filter:brightness(0.75) contrast(1.05);transition:transform 6s ease}
.editorial:hover .ed-img img{transform:scale(1.04)}
.ed-content{
  display:flex;flex-direction:column;justify-content:center;
  padding:5rem 5rem;background:var(--card);
}
.ed-tag{
  display:inline-flex;align-items:center;gap:0.5rem;
  background:var(--amber3);border:1px solid rgba(212,168,83,0.25);
  border-radius:20px;padding:0.3rem 0.9rem;
  font-size:0.66rem;font-weight:600;letter-spacing:0.12em;text-transform:uppercase;
  color:var(--amber);margin-bottom:1.8rem;width:fit-content;
}
.ed-content h2{
  font-family:var(--ff-d);font-size:clamp(2rem,3.5vw,3rem);
  font-weight:700;line-height:1.05;margin-bottom:1.2rem;
}
.ed-content h2 em{font-style:italic;color:var(--amber);font-weight:300}
.ed-content p{color:var(--ash);font-size:0.9rem;line-height:1.9;margin-bottom:2rem;max-width:340px}
.ed-perks{display:flex;flex-direction:column;gap:0.65rem;margin-bottom:2.2rem}
.ed-perk{display:flex;align-items:center;gap:0.8rem;font-size:0.85rem;color:var(--snow)}
.ed-perk-dot{width:5px;height:5px;background:var(--amber);border-radius:50%;flex-shrink:0}

/* ─── NEWSLETTER ─── */
.newsletter{
  background:var(--ink2);padding:5.5rem 8%;
  text-align:center;
  border-top:1px solid var(--rim);
}
.newsletter h2{
  font-family:var(--ff-d);font-size:clamp(1.8rem,3.5vw,2.8rem);
  font-weight:700;margin-bottom:0.6rem;
}
.newsletter h2 em{font-style:italic;color:var(--amber)}
.newsletter-sub{color:var(--ash);font-size:0.9rem;margin-bottom:2.5rem}
.nl-form{
  display:flex;max-width:420px;margin:0 auto;
  border:1px solid var(--rim2);border-radius:6px;overflow:hidden;transition:all 0.25s;
}
.nl-form:focus-within{border-color:var(--amber);box-shadow:0 0 0 3px rgba(212,168,83,0.1)}
.nl-form input{
  flex:1;background:var(--ink3);border:none;color:var(--snow);
  padding:0.9rem 1.2rem;font-size:0.88rem;
}
.nl-form input::placeholder{color:var(--fog)}
.nl-form button{
  background:var(--amber);color:#000;padding:0.9rem 1.4rem;
  font-size:0.72rem;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;
  transition:all 0.25s;white-space:nowrap;
}
.nl-form button:hover{background:var(--amber2)}

/* ─── FOOTER ─── */
footer{background:var(--ink);padding:5rem 8% 2.5rem;border-top:1px solid var(--rim)}
.footer-grid{display:grid;grid-template-columns:2.2fr 1fr 1fr 1fr;gap:4rem;margin-bottom:4rem}
.footer-logo{
  font-family:var(--ff-d);font-size:1.5rem;font-weight:700;
  letter-spacing:0.28em;color:var(--amber);text-transform:uppercase;margin-bottom:1rem;
}
.footer-brand p{color:var(--fog);font-size:0.84rem;line-height:1.85;max-width:260px;margin-bottom:1.5rem}
.socials{display:flex;gap:0.5rem}
.social{
  width:34px;height:34px;background:var(--panel);
  border:1px solid var(--rim);border-radius:6px;
  display:flex;align-items:center;justify-content:center;
  font-size:0.85rem;color:var(--ash);transition:all 0.25s;
}
.social:hover{border-color:var(--amber);color:var(--amber)}
.footer-col h5{
  font-size:0.7rem;letter-spacing:0.2em;text-transform:uppercase;
  color:var(--snow);margin-bottom:1.2rem;font-weight:600;
}
.footer-col ul li{margin-bottom:0.65rem}
.footer-col ul li a{color:var(--fog);font-size:0.84rem;transition:color 0.22s;cursor:pointer}
.footer-col ul li a:hover{color:var(--amber)}
.footer-bottom{
  border-top:1px solid var(--rim);padding-top:2rem;
  display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:1rem;
}
.footer-bottom p{color:var(--fog);font-size:0.78rem}

/* ═══════════════════════════════
   ╔══════════════════════╗
   ║  PRODUCTS PAGE       ║
   ╚══════════════════════╝
═══════════════════════════════ */
.shop-hero{
  background:var(--ink2);
  padding:4rem 8% 0;
  border-bottom:1px solid var(--rim);
  position:relative;overflow:hidden;
}
.shop-hero::before{
  content:'SHOP';position:absolute;
  right:-2%;top:-10%;
  font-family:var(--ff-d);font-size:18rem;font-weight:700;
  color:rgba(255,255,255,0.025);pointer-events:none;line-height:1;letter-spacing:0.05em;
}
.shop-hero-inner{
  display:flex;align-items:flex-end;justify-content:space-between;
  flex-wrap:wrap;gap:1.5rem;padding-bottom:2.5rem;
}
.shop-hero h1{
  font-family:var(--ff-d);font-size:clamp(2rem,5vw,4.5rem);
  font-weight:700;line-height:1;color:var(--snow);
}
.shop-hero h1 em{font-style:italic;font-weight:300;color:var(--amber)}
.shop-hero-count{
  font-size:0.78rem;letter-spacing:0.1em;text-transform:uppercase;
  color:var(--ash);display:flex;align-items:center;gap:0.5rem;
}
.shop-hero-count span{
  background:var(--amber3);border:1px solid rgba(212,168,83,0.3);
  border-radius:20px;padding:0.2rem 0.75rem;
  color:var(--amber);font-weight:600;
}

/* ─── SHOP LAYOUT ─── */
.shop-layout{display:grid;grid-template-columns:240px 1fr;min-height:calc(100vh - var(--nav) - 220px)}

/* ─── SIDEBAR ─── */
.shop-sidebar{
  background:var(--ink2);border-right:1px solid var(--rim);
  padding:2rem 0;position:sticky;top:var(--nav);height:calc(100vh - var(--nav));overflow-y:auto;
}
.sidebar-section{margin-bottom:0.25rem}
.sidebar-section-head{
  padding:0.6rem 1.6rem;
  font-size:0.66rem;letter-spacing:0.2em;text-transform:uppercase;
  color:var(--fog);font-weight:600;
}
.cat-filter-btn{
  display:flex;align-items:center;justify-content:space-between;
  padding:0.75rem 1.6rem;cursor:pointer;
  transition:all 0.22s var(--ease);
  border-left:2px solid transparent;
}
.cat-filter-btn:hover{background:var(--glass);border-left-color:rgba(212,168,83,0.4)}
.cat-filter-btn.active{background:rgba(212,168,83,0.08);border-left-color:var(--amber)}
.cfb-left{display:flex;align-items:center;gap:0.7rem}
.cfb-color{width:8px;height:8px;border-radius:50%;flex-shrink:0}
.cfb-name{font-size:0.82rem;color:var(--ash);transition:color 0.22s}
.cat-filter-btn:hover .cfb-name,.cat-filter-btn.active .cfb-name{color:var(--snow)}
.cat-filter-btn.active .cfb-name{color:var(--amber)}
.cfb-count{
  font-size:0.68rem;background:var(--panel);border-radius:20px;
  padding:1px 7px;color:var(--fog);transition:all 0.22s;
}
.cat-filter-btn.active .cfb-count{background:var(--amber3);color:var(--amber)}
.sidebar-divider{height:1px;background:var(--rim);margin:1rem 1.6rem}
.sort-section{padding:0.5rem 1.6rem 1rem}
.sort-label{font-size:0.66rem;letter-spacing:0.16em;text-transform:uppercase;color:var(--fog);margin-bottom:0.6rem;display:block}
.sort-select{
  width:100%;background:var(--panel);border:1px solid var(--rim);
  color:var(--snow);padding:0.55rem 0.8rem;border-radius:6px;
  font-size:0.82rem;outline:none;cursor:pointer;transition:border-color 0.22s;
}
.sort-select:focus{border-color:var(--amber)}
.sort-select option{background:var(--ink2)}
.sidebar-mini-stat{
  padding:0.5rem 1.6rem;
  display:flex;justify-content:space-between;align-items:center;
  font-size:0.78rem;
}
.sms-label{color:var(--fog)}
.sms-val{color:var(--amber);font-weight:500}

/* ─── SHOP CONTENT ─── */
.shop-content{background:var(--ink);padding:2rem}

/* toolbar */
.shop-toolbar{
  display:flex;align-items:center;justify-content:space-between;
  flex-wrap:wrap;gap:0.75rem;margin-bottom:1.5rem;
  padding-bottom:1rem;border-bottom:1px solid var(--rim);
}
.active-filter-tag{
  display:inline-flex;align-items:center;gap:0.5rem;
  background:var(--amber3);border:1px solid rgba(212,168,83,0.3);
  border-radius:20px;padding:0.3rem 0.9rem;
  font-size:0.72rem;font-weight:600;letter-spacing:0.06em;color:var(--amber);
}
.view-switcher{display:flex;gap:3px}
.view-sw-btn{
  background:var(--panel);border:1px solid var(--rim);color:var(--fog);
  padding:0.4rem 0.65rem;border-radius:5px;cursor:pointer;font-size:0.82rem;
  transition:all 0.22s;
}
.view-sw-btn.active{background:var(--amber3);border-color:rgba(212,168,83,0.35);color:var(--amber)}

/* product grid */
.products-grid{
  display:grid;
  grid-template-columns:repeat(auto-fill,minmax(240px,1fr));
  gap:1.25rem;
}
.products-grid.list-view{grid-template-columns:1fr}

/* card */
.product-card{
  background:var(--card);border:1px solid var(--rim);
  border-radius:12px;overflow:hidden;
  transition:all 0.3s var(--ease);cursor:pointer;position:relative;
}
.product-card:hover{
  transform:translateY(-6px);
  border-color:rgba(212,168,83,0.3);
  box-shadow:0 20px 48px rgba(0,0,0,0.5);
}
.product-card.hidden{display:none}

/* list view card */
.products-grid.list-view .product-card{
  display:grid;grid-template-columns:180px 1fr;border-radius:10px;
}
.products-grid.list-view .product-card:hover{transform:translateY(-2px)}
.products-grid.list-view .pc-img{height:150px}
.products-grid.list-view .pc-body{padding:1.5rem;display:flex;flex-direction:column;justify-content:space-between}

.pc-badge{
  position:absolute;top:12px;left:12px;z-index:2;
  font-size:0.62rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;
  padding:3px 10px;border-radius:20px;
}
.bdg-new{background:var(--amber);color:#000}
.bdg-sale{background:var(--rose);color:#fff}
.pc-img{
  width:100%;height:220px;position:relative;overflow:hidden;background:var(--ink3);
}
.pc-img img{
  width:100%;height:100%;object-fit:cover;
  filter:brightness(0.88);transition:transform 0.6s var(--ease);
}
.product-card:hover .pc-img img{transform:scale(1.07)}
.pc-overlay{
  position:absolute;inset:0;background:rgba(0,0,0,0.5);
  display:flex;align-items:center;justify-content:center;
  gap:0.6rem;opacity:0;transition:opacity 0.28s var(--ease);
}
.product-card:hover .pc-overlay{opacity:1}
.po-btn{
  background:rgba(240,200,118,0.95);color:#000;
  padding:0.55rem 1rem;border-radius:4px;
  font-size:0.7rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;
  transition:all 0.22s;border:none;cursor:pointer;font-family:var(--ff-s);
}
.po-btn:hover{background:var(--snow);transform:scale(1.04)}
.pc-body{padding:1.1rem 1.3rem 1.3rem}
.pc-cat{font-size:0.66rem;letter-spacing:0.16em;text-transform:uppercase;color:var(--amber);margin-bottom:0.4rem;font-weight:500}
.pc-name{font-family:var(--ff-d);font-size:1rem;font-weight:600;color:var(--snow);line-height:1.25;margin-bottom:0.65rem}
.pc-stars{display:flex;align-items:center;gap:0.35rem;margin-bottom:0.75rem}
.stars{color:var(--amber);font-size:0.72rem;letter-spacing:1px}
.stars-n{color:var(--fog);font-size:0.68rem}
.pc-price-row{display:flex;align-items:center;justify-content:space-between}
.pc-prices{display:flex;align-items:baseline;gap:0.5rem}
.pc-price{font-size:1.1rem;font-weight:700;color:var(--snow)}
.pc-old{font-size:0.82rem;color:var(--fog);text-decoration:line-through}
.pc-add{
  width:34px;height:34px;background:var(--ink3);border:1px solid var(--rim2);
  border-radius:6px;display:flex;align-items:center;justify-content:center;
  color:var(--ash);font-size:1.05rem;transition:all 0.22s;
}
.pc-add:hover{background:var(--amber);border-color:var(--amber);color:#000}
.no-results{
  grid-column:1/-1;text-align:center;
  padding:5rem 2rem;color:var(--fog);
  font-family:var(--ff-d);font-style:italic;font-size:1.1rem;
}

/* ═══════════════════════════════
   PRODUCT DETAIL PAGE
═══════════════════════════════ */
.page-crumb{
  padding:1.5rem 8%;
  background:var(--ink2);border-bottom:1px solid var(--rim);
}
.breadcrumb{display:flex;align-items:center;gap:0.5rem;font-size:0.78rem;color:var(--fog)}
.breadcrumb span{cursor:pointer;transition:color 0.22s}
.breadcrumb span:hover{color:var(--amber)}
.bc-sep{color:var(--rim2)}
.detail-grid{display:grid;grid-template-columns:1fr 1fr;gap:4rem;padding:4rem 8%}
.d-gallery .d-main-img{
  width:100%;height:480px;background:var(--ink3);
  border-radius:12px;overflow:hidden;border:1px solid var(--rim);margin-bottom:0.8rem;
}
.d-gallery .d-main-img img{width:100%;height:100%;object-fit:cover;filter:brightness(0.88)}
.d-thumbs{display:flex;gap:0.6rem}
.d-thumb{
  width:76px;height:76px;background:var(--card);border:1px solid var(--rim);
  border-radius:8px;overflow:hidden;cursor:pointer;transition:border-color 0.22s;
}
.d-thumb img{width:100%;height:100%;object-fit:cover}
.d-thumb.active,.d-thumb:hover{border-color:var(--amber)}
.d-info{padding-top:0.75rem}
.d-cat{font-size:0.68rem;color:var(--amber);letter-spacing:0.16em;text-transform:uppercase;margin-bottom:0.7rem;font-weight:500}
.d-name{font-family:var(--ff-d);font-size:clamp(1.8rem,3vw,2.5rem);font-weight:700;margin-bottom:0.9rem;line-height:1.05}
.d-rating{display:flex;align-items:center;gap:1rem;margin-bottom:1.4rem}
.d-price{margin-bottom:1.5rem}
.d-price-now{font-family:var(--ff-d);font-size:2.2rem;font-weight:700;color:var(--amber)}
.d-price-was{color:var(--fog);text-decoration:line-through;font-size:1rem;margin-left:0.7rem}
.d-desc{color:var(--ash);font-size:0.9rem;line-height:1.9;margin-bottom:1.5rem;padding-bottom:1.5rem;border-bottom:1px solid var(--rim)}
.opt-label{font-size:0.7rem;letter-spacing:0.12em;text-transform:uppercase;color:var(--ash);display:block;margin-bottom:0.6rem}
.color-row{display:flex;gap:0.6rem;margin-bottom:1.3rem}
.c-dot{width:26px;height:26px;border-radius:50%;cursor:pointer;border:2px solid transparent;transition:all 0.22s}
.c-dot.active,.c-dot:hover{border-color:var(--snow);transform:scale(1.2)}
.size-row{display:flex;gap:0.5rem;flex-wrap:wrap;margin-bottom:1.3rem}
.sz-btn{
  padding:0.4rem 0.9rem;background:var(--card);border:1px solid var(--rim);
  border-radius:4px;font-size:0.8rem;color:var(--ash);cursor:pointer;transition:all 0.22s;
}
.sz-btn.active,.sz-btn:hover{border-color:var(--amber);color:var(--amber)}
.qty-row{display:flex;align-items:center;gap:1.5rem;margin-bottom:1.8rem}
.qty-ctrl{display:flex;align-items:center;background:var(--card);border:1px solid var(--rim);border-radius:6px;overflow:hidden}
.qty-btn{background:none;color:var(--snow);width:38px;height:38px;font-size:1.1rem;transition:background 0.22s}
.qty-btn:hover{background:var(--rim)}
.qty-val{width:48px;text-align:center;font-size:0.95rem;color:var(--snow);background:none;border:none}
.d-actions{display:flex;gap:0.75rem;flex-wrap:wrap}
.wish-btn{
  width:46px;height:46px;background:var(--ink3);border:1px solid var(--rim2);
  border-radius:6px;display:flex;align-items:center;justify-content:center;
  font-size:1.15rem;transition:all 0.22s;flex-shrink:0;
}
.wish-btn:hover{border-color:var(--rose);color:var(--rose)}
.d-features{display:grid;grid-template-columns:1fr 1fr;gap:0.7rem;margin-top:1.5rem;padding-top:1.5rem;border-top:1px solid var(--rim)}
.d-feat{display:flex;align-items:center;gap:0.5rem;font-size:0.8rem;color:var(--ash)}
.d-feat-ic{color:var(--amber)}

/* reviews */
.reviews{padding:4rem 8%;background:var(--ink2);border-top:1px solid var(--rim)}
.review-card{background:var(--card);border:1px solid var(--rim);border-radius:12px;padding:1.4rem;margin-bottom:0.9rem}
.rev-head{display:flex;align-items:center;justify-content:space-between;margin-bottom:0.7rem}
.rev-name{font-weight:600;font-size:0.9rem}
.rev-date{color:var(--fog);font-size:0.76rem}
.rev-text{color:var(--ash);font-size:0.88rem;line-height:1.75}

/* ═══════════════════════════════
   PROFILE PAGE
═══════════════════════════════ */
.profile-layout{display:grid;grid-template-columns:250px 1fr;gap:2rem;padding:3rem 8%}
.profile-sidebar{position:sticky;top:calc(var(--nav) + 1rem);height:fit-content}
.profile-card{background:var(--card);border:1px solid var(--rim);border-radius:12px;padding:2rem;text-align:center;margin-bottom:1rem}
.profile-avatar{width:72px;height:72px;background:var(--amber3);border:2px solid var(--amber);border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:1.8rem;margin:0 auto 0.9rem}
.profile-name{font-family:var(--ff-d);font-size:1.2rem;margin-bottom:0.2rem}
.profile-email{font-size:0.8rem;color:var(--fog)}
.profile-nav{background:var(--card);border:1px solid var(--rim);border-radius:12px;overflow:hidden}
.pnav-item{display:flex;align-items:center;gap:0.7rem;padding:0.85rem 1.4rem;font-size:0.82rem;color:var(--fog);cursor:pointer;transition:all 0.22s;border-left:2px solid transparent}
.pnav-item:hover,.pnav-item.active{color:var(--amber);background:var(--amber3);border-left-color:var(--amber)}
.profile-content{min-height:400px}
.profile-panel{display:none}
.profile-panel.active{display:block}
.pp-title{font-family:var(--ff-d);font-size:1.6rem;font-weight:700;margin-bottom:1.5rem;padding-bottom:1rem;border-bottom:1px solid var(--rim)}
.info-grid{display:grid;grid-template-columns:1fr 1fr;gap:1.2rem;margin-bottom:2rem}
.order-row{background:var(--card);border:1px solid var(--rim);border-radius:10px;padding:1.1rem 1.4rem;display:flex;align-items:center;gap:1.5rem;margin-bottom:0.7rem;transition:border-color 0.22s}
.order-row:hover{border-color:rgba(212,168,83,0.3)}
.order-id{font-size:0.76rem;color:var(--amber);letter-spacing:0.08em;margin-bottom:0.2rem}
.order-date{font-size:0.76rem;color:var(--fog)}
.order-name{font-size:0.88rem;margin-bottom:0.2rem}
.order-total{font-weight:700;color:var(--amber);margin-left:auto;white-space:nowrap}
.order-status{padding:0.22rem 0.7rem;border-radius:20px;font-size:0.65rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;white-space:nowrap}
.st-delivered{background:rgba(63,168,154,0.15);color:var(--teal)}
.st-shipped{background:rgba(100,180,246,0.15);color:#64b5f6}
.st-processing{background:rgba(212,168,83,0.15);color:var(--amber)}
.addr-card{background:var(--card);border:1px solid var(--rim);border-radius:10px;padding:1.4rem;margin-bottom:0.7rem}
.addr-lbl{font-size:0.68rem;letter-spacing:0.14em;text-transform:uppercase;color:var(--amber);margin-bottom:0.45rem;font-weight:500}
.addr-text{font-size:0.86rem;color:var(--ash);line-height:1.75}
.addr-acts{display:flex;gap:0.4rem;margin-top:0.65rem}
.addr-btn{font-size:0.7rem;color:var(--fog);padding:0.28rem 0.6rem;border:1px solid var(--rim);border-radius:4px;transition:all 0.22s;background:none;cursor:pointer}
.addr-btn:hover{border-color:var(--amber);color:var(--amber)}

/* ═══════════════════════════════
   CHECKOUT PAGE
═══════════════════════════════ */
.checkout-layout{display:grid;grid-template-columns:1fr 360px;gap:2rem;padding:3rem 8%;align-items:start}
.co-box{background:var(--card);border:1px solid var(--rim);border-radius:12px;padding:2rem;margin-bottom:1.25rem}
.co-box-title{font-size:0.72rem;letter-spacing:0.16em;text-transform:uppercase;color:var(--amber);margin-bottom:1.4rem;padding-bottom:0.7rem;border-bottom:1px solid var(--rim);font-weight:500}
.pay-opts{display:flex;flex-direction:column;gap:0.65rem}
.pay-opt{display:flex;align-items:center;gap:1rem;background:var(--ink3);border:1px solid var(--rim2);border-radius:6px;padding:0.9rem;cursor:pointer;transition:all 0.22s;font-size:0.86rem}
.pay-opt.selected{border-color:var(--amber)}
.pay-opt input{accent-color:var(--amber)}
.co-summary{background:var(--card);border:1px solid var(--rim);border-radius:12px;padding:1.4rem;position:sticky;top:calc(var(--nav) + 1rem)}
.co-sum-title{font-family:var(--ff-d);font-size:1.05rem;font-weight:700;margin-bottom:1.4rem;padding-bottom:0.9rem;border-bottom:1px solid var(--rim)}
.sum-item{display:flex;align-items:center;gap:0.7rem;padding:0.7rem 0;border-bottom:1px solid var(--rim)}
.sum-item-img{width:46px;height:46px;background:var(--ink3);border-radius:6px;overflow:hidden;flex-shrink:0}
.sum-item-img img{width:100%;height:100%;object-fit:cover}
.sum-item-info{flex:1;font-size:0.8rem;color:var(--ash)}
.sum-item-price{font-size:0.83rem;color:var(--amber);font-weight:600;white-space:nowrap}
.sum-row{display:flex;justify-content:space-between;font-size:0.86rem;margin-top:0.7rem}
.sum-row .lbl{color:var(--fog)}
.sum-row.total{font-size:0.98rem;font-weight:700;margin-top:0.9rem;padding-top:0.7rem;border-top:1px solid var(--rim)}
.sum-row.total .val{color:var(--amber)}

/* ═══════════════════════════════
   OVERLAYS / DRAWERS
═══════════════════════════════ */
.overlay-bg{position:fixed;inset:0;background:rgba(0,0,0,0.65);z-index:400;opacity:0;pointer-events:none;transition:opacity 0.3s}
.overlay-bg.open{opacity:1;pointer-events:all}
.cart-drawer{position:fixed;top:0;right:0;bottom:0;width:380px;background:var(--ink2);border-left:1px solid var(--rim2);z-index:500;transform:translateX(100%);transition:transform 0.35s var(--ease);display:flex;flex-direction:column}
.cart-drawer.open{transform:translateX(0)}
.wish-drawer{position:fixed;top:0;right:0;bottom:0;width:380px;background:var(--ink2);border-left:1px solid var(--rim2);z-index:500;transform:translateX(100%);transition:transform 0.35s var(--ease);display:flex;flex-direction:column}
.wish-drawer.open{transform:translateX(0)}
.drawer-head{display:flex;align-items:center;justify-content:space-between;padding:1.4rem 1.4rem 1rem;border-bottom:1px solid var(--rim)}
.drawer-head h3{font-family:var(--ff-d);font-size:1.2rem;font-weight:700}
.drawer-close{background:none;color:var(--fog);font-size:1.3rem;transition:color 0.22s}
.drawer-close:hover{color:var(--snow)}
.cart-empty{flex:1;display:flex;flex-direction:column;align-items:center;justify-content:center;color:var(--fog);gap:1rem;padding:2rem;text-align:center;font-size:0.9rem}
.cart-empty-icon{font-size:3rem;opacity:0.35}
.cart-items{flex:1;overflow-y:auto;padding:1rem 1.4rem}
.cart-item{display:flex;gap:0.9rem;padding:0.9rem 0;border-bottom:1px solid var(--rim)}
.ci-img{width:62px;height:62px;border-radius:7px;overflow:hidden;background:var(--ink3);flex-shrink:0}
.ci-img img{width:100%;height:100%;object-fit:cover}
.ci-info{flex:1}
.ci-name{font-size:0.86rem;margin-bottom:0.2rem}
.ci-price{font-size:0.8rem;color:var(--amber)}
.ci-rm{background:none;color:var(--fog);font-size:1rem;transition:color 0.22s;align-self:center}
.ci-rm:hover{color:var(--rose)}
.cart-footer{padding:1.4rem;border-top:1px solid var(--rim)}
.cart-total-row{display:flex;justify-content:space-between;margin-bottom:1.1rem;font-size:0.9rem}
.cart-total-row strong{color:var(--amber);font-size:1.05rem}
.wish-items{flex:1;overflow-y:auto;padding:1rem 1.4rem}
.wish-item{display:flex;gap:0.9rem;padding:0.9rem 0;border-bottom:1px solid var(--rim);align-items:center}
.wi-img{width:62px;height:62px;border-radius:7px;overflow:hidden;background:var(--ink3);flex-shrink:0}
.wi-img img{width:100%;height:100%;object-fit:cover}
.wi-info{flex:1}
.wi-name{font-size:0.86rem;margin-bottom:0.2rem}
.wi-price{font-size:0.8rem;color:var(--amber)}
.wi-acts{display:flex;flex-direction:column;gap:0.35rem}
.wi-add{background:var(--amber);color:#000;padding:0.3rem 0.7rem;border-radius:4px;font-size:0.64rem;font-weight:700;letter-spacing:0.07em;text-transform:uppercase;transition:all 0.22s;cursor:pointer;border:none}
.wi-add:hover{background:var(--amber2)}
.wi-rm{background:none;color:var(--fog);font-size:0.8rem;transition:color 0.22s;cursor:pointer;border:none}
.wi-rm:hover{color:var(--rose)}

/* ═══════════════════════════════
   MODALS
═══════════════════════════════ */
.modal-wrap{position:fixed;inset:0;z-index:600;display:flex;align-items:center;justify-content:center;padding:1rem;background:rgba(0,0,0,0.75);opacity:0;pointer-events:none;transition:opacity 0.25s}
.modal-wrap.open{opacity:1;pointer-events:all}
.modal-box{background:var(--ink2);border:1px solid var(--rim2);border-radius:16px;width:100%;max-width:480px;padding:2.5rem;box-shadow:0 40px 80px rgba(0,0,0,0.7);transform:scale(0.94);transition:transform 0.25s}
.modal-wrap.open .modal-box{transform:scale(1)}
.modal-head{display:flex;align-items:center;justify-content:space-between;margin-bottom:1.8rem}
.modal-head h3{font-family:var(--ff-d);font-size:1.4rem;font-weight:700}
.modal-close-btn{background:none;color:var(--fog);font-size:1.3rem;transition:color 0.22s}
.modal-close-btn:hover{color:var(--snow)}
.auth-tabs{display:flex;border-bottom:1px solid var(--rim);margin-bottom:1.6rem}
.auth-tab{flex:1;padding:0.7rem;text-align:center;font-size:0.76rem;letter-spacing:0.1em;text-transform:uppercase;color:var(--fog);cursor:pointer;border-bottom:2px solid transparent;transition:all 0.22s}
.auth-tab.active{color:var(--amber);border-bottom-color:var(--amber)}
.auth-panel{display:none}
.auth-panel.active{display:block}
.form-group{margin-bottom:1.1rem}
.form-label{font-size:0.7rem;letter-spacing:0.1em;text-transform:uppercase;color:var(--ash);display:block;margin-bottom:0.45rem}
.form-input{width:100%;background:var(--ink3);border:1px solid var(--rim2);color:var(--snow);padding:0.72rem 1rem;border-radius:6px;font-size:0.88rem;transition:all 0.22s}
.form-input:focus{border-color:var(--amber);box-shadow:0 0 0 3px rgba(212,168,83,0.1)}
.form-input::placeholder{color:var(--fog)}
.form-row{display:grid;grid-template-columns:1fr 1fr;gap:1rem}
.form-link{font-size:0.78rem;color:var(--amber);cursor:pointer}
.form-link:hover{text-decoration:underline}
.form-divider{text-align:center;color:var(--fog);font-size:0.76rem;margin:0.7rem 0;position:relative}
.form-divider::before,.form-divider::after{content:'';position:absolute;top:50%;width:42%;height:1px;background:var(--rim)}
.form-divider::before{left:0}
.form-divider::after{right:0}
.auth-footer-text{text-align:center;font-size:0.8rem;color:var(--fog);margin-top:1.1rem}

/* ═══════════════════════════════
   TOAST
═══════════════════════════════ */
.toast-wrap{position:fixed;bottom:1.5rem;right:1.5rem;z-index:700;display:flex;flex-direction:column;gap:0.5rem}
.toast{background:var(--card);border:1px solid var(--rim2);border-radius:10px;padding:0.85rem 1.1rem;display:flex;align-items:center;gap:0.65rem;min-width:250px;box-shadow:0 20px 48px rgba(0,0,0,0.5);animation:slideInToast 0.3s var(--ease);border-left:3px solid var(--amber)}
.toast.error{border-left-color:var(--rose)}
.toast-msg{font-size:0.83rem}
@keyframes slideInToast{from{opacity:0;transform:translateX(30px)}to{opacity:1;transform:translateX(0)}}

/* ═══════════════════════════════
   RESPONSIVE
═══════════════════════════════ */
@media(max-width:1100px){
  .hero{grid-template-columns:1fr}
  .hero-right{display:none}
  .hero-left{padding:6rem 8%}
  .editorial{grid-template-columns:1fr}
  .ed-img{height:320px}
  .footer-grid{grid-template-columns:1fr 1fr}
  .features-strip{grid-template-columns:1fr 1fr}
  .detail-grid{grid-template-columns:1fr}
  .profile-layout{grid-template-columns:1fr}
  .profile-sidebar{position:static}
  .checkout-layout{grid-template-columns:1fr}
  .shop-layout{grid-template-columns:1fr}
  .shop-sidebar{position:static;height:auto;display:flex;flex-wrap:wrap;gap:0.5rem;padding:1rem 1.5rem;border-right:none;border-bottom:1px solid var(--rim)}
  .cat-filter-btn{border-left:none;border-radius:20px;border:1px solid var(--rim);padding:0.4rem 1rem;background:var(--panel)}
  .cat-filter-btn.active{background:var(--amber3);border-color:rgba(212,168,83,0.4)}
  .sidebar-section-head,.sidebar-divider,.sort-section,.sidebar-mini-stat{display:none}
}
@media(max-width:768px){
  .nav-search,.nav-links{display:none}
  .hamburger{display:flex}
  .products-grid{grid-template-columns:repeat(auto-fill,minmax(160px,1fr))}
  .hero-left{padding:4rem 5%}
  .section{padding:4rem 5%}
  .features-strip{grid-template-columns:1fr 1fr;padding:0 5%}
  .footer-grid{grid-template-columns:1fr;gap:2rem}
  footer{padding:3.5rem 5% 2rem}
  .stats-bar{grid-template-columns:1fr 1fr}
  .cart-drawer,.wish-drawer{width:100%}
  .info-grid,.form-row{grid-template-columns:1fr}
}

/* ═══════════════════════════════
   ABOUT PAGE
═══════════════════════════════ */
.about-hero{
  min-height:52vh;display:flex;align-items:center;
  background:var(--ink2);position:relative;overflow:hidden;
  padding:6rem 8%;border-bottom:1px solid var(--rim);
}
.about-hero::before{
  content:'ABOUT';position:absolute;right:-2%;top:50%;transform:translateY(-50%);
  font-family:var(--ff-d);font-size:22rem;font-weight:700;line-height:1;
  color:rgba(255,255,255,0.018);pointer-events:none;letter-spacing:0.05em;white-space:nowrap;
}
.about-hero-inner{max-width:680px;z-index:2}
.about-tag{display:inline-flex;align-items:center;gap:0.6rem;background:var(--amber3);border:1px solid rgba(212,168,83,0.3);border-radius:20px;padding:0.3rem 1rem;font-size:0.68rem;font-weight:600;letter-spacing:0.14em;text-transform:uppercase;color:var(--amber);margin-bottom:2rem}
.about-hero h1{font-family:var(--ff-d);font-size:clamp(2.5rem,6vw,5.5rem);font-weight:700;line-height:1.0;margin-bottom:1.5rem}
.about-hero h1 em{font-style:italic;font-weight:300;color:var(--amber)}
.about-hero p{color:var(--ash);font-size:1rem;line-height:1.9;max-width:560px}

.about-story{padding:6rem 8%;display:grid;grid-template-columns:1fr 1fr;gap:6rem;align-items:center}
.about-story-img{position:relative;border-radius:16px;overflow:hidden;height:460px}
.about-story-img img{width:100%;height:100%;object-fit:cover;filter:brightness(0.75) contrast(1.1)}
.about-story-img-overlay{position:absolute;bottom:1.5rem;left:1.5rem;background:rgba(8,9,13,0.85);border:1px solid var(--rim2);border-radius:10px;padding:1rem 1.4rem;backdrop-filter:blur(12px)}
.asio-year{font-family:var(--ff-d);font-size:2.2rem;font-weight:700;color:var(--amber);line-height:1}
.asio-label{font-size:0.68rem;letter-spacing:0.14em;text-transform:uppercase;color:var(--ash);margin-top:0.25rem}
.about-story-text h2{font-family:var(--ff-d);font-size:clamp(1.8rem,3vw,2.8rem);font-weight:700;line-height:1.1;margin-bottom:1.2rem}
.about-story-text h2 em{font-style:italic;color:var(--amber)}
.about-story-text p{color:var(--ash);font-size:0.92rem;line-height:1.95;margin-bottom:1.2rem}

.about-values{background:var(--ink2);padding:5rem 8%;border-top:1px solid var(--rim);border-bottom:1px solid var(--rim)}
.about-values-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:1.5rem;margin-top:3rem}
.value-card{background:var(--card);border:1px solid var(--rim);border-radius:14px;padding:2.2rem 1.8rem;transition:all 0.28s var(--ease);position:relative;overflow:hidden}
.value-card::after{content:'';position:absolute;bottom:0;left:0;right:0;height:2px;background:var(--amber);transform:scaleX(0);transition:transform 0.3s var(--ease)}
.value-card:hover{border-color:rgba(212,168,83,0.3);transform:translateY(-4px)}
.value-card:hover::after{transform:scaleX(1)}
.value-icon{font-size:2rem;margin-bottom:1rem;display:block}
.value-title{font-family:var(--ff-d);font-size:1.2rem;font-weight:700;margin-bottom:0.7rem}
.value-desc{color:var(--ash);font-size:0.86rem;line-height:1.8}

.about-team{padding:5rem 8%}
.about-team-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:1.5rem;margin-top:3rem}
.team-card{background:var(--card);border:1px solid var(--rim);border-radius:14px;padding:2rem;text-align:center;transition:all 0.28s var(--ease)}
.team-card:hover{border-color:rgba(212,168,83,0.3);transform:translateY(-4px)}
.team-avatar{width:72px;height:72px;border-radius:50%;margin:0 auto 1rem;display:flex;align-items:center;justify-content:center;font-size:1.8rem;border:2px solid var(--rim2)}
.team-name{font-family:var(--ff-d);font-size:1.1rem;font-weight:700;margin-bottom:0.25rem}
.team-role{font-size:0.72rem;letter-spacing:0.12em;text-transform:uppercase;color:var(--amber);font-weight:500}
.team-stat{margin-top:1rem;padding-top:1rem;border-top:1px solid var(--rim);font-size:0.8rem;color:var(--fog)}

.about-numbers{background:var(--ink2);border-top:1px solid var(--rim);padding:4rem 8%;display:grid;grid-template-columns:repeat(4,1fr);gap:2rem;text-align:center}
.an-val{font-family:var(--ff-d);font-size:2.8rem;font-weight:700;color:var(--amber);line-height:1}
.an-lbl{font-size:0.7rem;letter-spacing:0.16em;text-transform:uppercase;color:var(--fog);margin-top:0.4rem}

@media(max-width:900px){
  .about-story{grid-template-columns:1fr}
  .about-story-img{height:280px}
  .about-values-grid{grid-template-columns:1fr 1fr}
  .about-numbers{grid-template-columns:1fr 1fr}
}

/* ═══════════════════════════════
   CONTACT PAGE
═══════════════════════════════ */
.contact-hero{
  padding:5rem 8% 3rem;background:var(--ink2);
  border-bottom:1px solid var(--rim);position:relative;overflow:hidden;
}
.contact-hero::before{
  content:'CONTACT';position:absolute;right:-2%;top:50%;transform:translateY(-50%);
  font-family:var(--ff-d);font-size:18rem;font-weight:700;
  color:rgba(255,255,255,0.018);pointer-events:none;letter-spacing:0.05em;white-space:nowrap;
}
.contact-hero h1{font-family:var(--ff-d);font-size:clamp(2.5rem,5vw,4.5rem);font-weight:700;line-height:1.05;margin-bottom:0.6rem}
.contact-hero h1 em{font-style:italic;color:var(--amber)}
.contact-hero p{color:var(--ash);font-size:0.92rem;max-width:500px}

.contact-layout{display:grid;grid-template-columns:1fr 1fr;gap:4rem;padding:5rem 8%;align-items:start}

.contact-info h2{font-family:var(--ff-d);font-size:1.8rem;font-weight:700;margin-bottom:0.5rem}
.contact-info p{color:var(--ash);font-size:0.9rem;line-height:1.85;margin-bottom:2.5rem}
.contact-detail-row{display:flex;align-items:flex-start;gap:1rem;margin-bottom:1.5rem}
.cdr-icon{width:42px;height:42px;background:var(--amber3);border:1px solid rgba(212,168,83,0.3);border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:1.1rem;flex-shrink:0;margin-top:0.1rem}
.cdr-label{font-size:0.68rem;letter-spacing:0.14em;text-transform:uppercase;color:var(--fog);margin-bottom:0.2rem;font-weight:500}
.cdr-value{font-size:0.9rem;color:var(--snow)}

.team-section-title{font-family:var(--ff-d);font-size:1.4rem;font-weight:700;margin-bottom:1.5rem;padding-bottom:0.75rem;border-bottom:1px solid var(--rim)}
.member-card{background:var(--card);border:1px solid var(--rim);border-radius:12px;padding:1.3rem 1.5rem;margin-bottom:0.85rem;display:flex;align-items:center;gap:1.2rem;transition:all 0.25s var(--ease)}
.member-card:hover{border-color:rgba(212,168,83,0.3);transform:translateX(4px)}
.mc-avatar{width:52px;height:52px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:1.3rem;font-family:var(--ff-d);font-weight:700;flex-shrink:0;border:2px solid var(--rim2)}
.mc-info{flex:1}
.mc-name{font-size:0.95rem;font-weight:500;color:var(--snow);margin-bottom:0.15rem}
.mc-role{font-size:0.68rem;letter-spacing:0.12em;text-transform:uppercase;color:var(--amber);font-weight:600;margin-bottom:0.3rem}
.mc-phone{font-size:0.82rem;color:var(--ash);display:flex;align-items:center;gap:0.4rem}
.mc-phone::before{content:'📞';font-size:0.72rem}
.mc-badge{font-size:0.62rem;background:var(--ink3);border:1px solid var(--rim);border-radius:20px;padding:0.15rem 0.6rem;color:var(--fog);white-space:nowrap;align-self:flex-start;margin-top:0.2rem}

.contact-form-box{background:var(--card);border:1px solid var(--rim);border-radius:16px;padding:2.5rem}
.contact-form-box h2{font-family:var(--ff-d);font-size:1.6rem;font-weight:700;margin-bottom:0.4rem}
.contact-form-box p{color:var(--ash);font-size:0.86rem;margin-bottom:2rem}
.cf-textarea{width:100%;background:var(--ink3);border:1px solid var(--rim2);color:var(--snow);padding:0.8rem 1rem;border-radius:8px;font-size:0.88rem;resize:vertical;min-height:120px;transition:all 0.22s;font-family:var(--ff-s)}
.cf-textarea:focus{border-color:var(--amber);box-shadow:0 0 0 3px rgba(212,168,83,0.1)}
.cf-textarea::placeholder{color:var(--fog)}
.map-strip{background:var(--ink2);border-top:1px solid var(--rim);padding:5rem 8%}
.map-strip h2{font-family:var(--ff-d);font-size:2rem;font-weight:700;margin-bottom:0.5rem}
.map-strip p{color:var(--ash);font-size:0.9rem;margin-bottom:2rem}
.map-placeholder{background:var(--card);border:1px solid var(--rim);border-radius:16px;height:320px;display:flex;flex-direction:column;align-items:center;justify-content:center;color:var(--fog);gap:1rem;font-size:0.9rem}
.map-placeholder-icon{font-size:3rem;opacity:0.4}

@media(max-width:900px){
  .contact-layout{grid-template-columns:1fr}
  .about-team-grid{grid-template-columns:1fr 1fr}
}
</style>
</head>
<body>

<!-- ── OVERLAYS ── -->
<div class="overlay-bg" id="overlayBg" onclick="closeAllDrawers()"></div>

<!-- CART DRAWER -->
<aside class="cart-drawer" id="cartDrawer">
  <div class="drawer-head">
    <h3>Cart <span id="cartCountLabel" style="color:var(--amber);font-size:.85rem">(0)</span></h3>
    <button class="drawer-close" onclick="closeAllDrawers()">✕</button>
  </div>
  <div class="cart-empty" id="cartEmpty"><div class="cart-empty-icon">🛍</div><p>Your cart is empty.</p></div>
  <div class="cart-items" id="cartItemsList" style="display:none"></div>
  <div class="cart-footer" id="cartFooter" style="display:none">
    <div class="cart-total-row"><span>Total</span><strong id="cartTotalAmt">$0</strong></div>
    <button class="btn btn-amber btn-full" onclick="closeAllDrawers();showPage('checkout')" style="margin-bottom:.6rem">Checkout →</button>
    <button class="btn btn-ghost btn-full btn-sm" onclick="closeAllDrawers()">Continue Shopping</button>
  </div>
</aside>

<!-- WISHLIST DRAWER -->
<aside class="wish-drawer" id="wishDrawer">
  <div class="drawer-head">
    <h3>Wishlist <span id="wishCountLabel" style="color:var(--amber);font-size:.85rem">(0)</span></h3>
    <button class="drawer-close" onclick="closeAllDrawers()">✕</button>
  </div>
  <div class="cart-empty" id="wishEmpty"><div class="cart-empty-icon">♡</div><p>Your wishlist is empty.</p></div>
  <div class="wish-items" id="wishItemsList" style="display:none"></div>
</aside>

<!-- AUTH MODAL -->
<div class="modal-wrap" id="authModal">
  <div class="modal-box">
    <div class="modal-head">
      <h3>Welcome to LUXE</h3>
      <button class="modal-close-btn" onclick="closeModal('authModal')">✕</button>
    </div>
    <div class="auth-tabs">
      <div class="auth-tab active" onclick="switchAuthTab('login')">Sign In</div>
      <div class="auth-tab" onclick="switchAuthTab('register')">Register</div>
    </div>
    <div class="auth-panel active" id="loginPanel">
      <form method="POST" action="backend/client_login.php">
        <div class="form-group"><label class="form-label">Email</label><input class="form-input" type="email" id="loginEmail" name="email" placeholder="you@email.com"/></div>
        <div class="form-group">
          <label class="form-label" style="display:flex;justify-content:space-between">Password <span class="form-link" onclick="showToast('Reset link sent!')">Forgot?</span></label>
          <input class="form-input" type="password" id="loginPass" name="password" placeholder="••••••••"/>
        </div>
           <button type="submit" class="btn btn-amber btn-full" style="margin-bottom:.9rem">Sign In</button>        <div class="form-divider">or</div>
        <div style="display:flex;gap:.65rem;margin-top:.65rem">
          <button class="btn btn-ghost btn-full btn-sm" onclick="doSocialLogin('Google')">🔵 Google</button>
          <button class="btn btn-ghost btn-full btn-sm" onclick="doSocialLogin('Apple')">🍎 Apple</button>
        </div>
        <p class="auth-footer-text">No account? <span class="form-link" onclick="switchAuthTab('register')">Register free</span></p>
      </form>
    </div>
    <form method="POST" action="backend/add_user.php">
    <div class="auth-panel" id="registerPanel">
      <div class="form-group"><label class="form-label">Full Name</label><input class="form-input" type="text" name="fullname" id="regFirst" placeholder="Jane Doe"/></div>
      <div class="form-group"><label class="form-label">Email</label><input class="form-input" type="email" name="email" id="regEmail" placeholder="you@email.com"/></div>
      <div class="form-group"><label class="form-label">Password</label><input class="form-input" type="password" name="password" id="regPass" placeholder="Min 6 characters"/></div>
      <div class="form-group"><label class="form-label">Confirm Password</label><input class="form-input" type="password" id="regConfirm" placeholder="Repeat password"/></div>
      <button type="submit" class="btn btn-amber btn-full">Create Account</button>
      <p class="auth-footer-text">Already a member? <span class="form-link" onclick="switchAuthTab('login')">Sign in</span></p>
    </div>
    </form>
  </div>
</div>

<!-- QUICK VIEW MODAL -->
<div class="modal-wrap" id="quickViewModal">
  <div class="modal-box" style="max-width:580px">
    <div class="modal-head">
      <h3 id="qvName"></h3>
      <button class="modal-close-btn" onclick="closeModal('quickViewModal')">✕</button>
    </div>
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:1.4rem">
      <div style="height:210px;background:var(--ink3);border-radius:10px;overflow:hidden">
        <img id="qvImg" src="" alt="" style="width:100%;height:100%;object-fit:cover"/>
      </div>
      <div>
        <div style="font-size:.68rem;letter-spacing:.16em;text-transform:uppercase;color:var(--amber);margin-bottom:.5rem" id="qvCat"></div>
        <div style="color:var(--amber);font-size:.72rem;margin-bottom:.4rem">★★★★★</div>
        <div style="font-size:1.4rem;font-weight:700;color:var(--amber);margin-bottom:.7rem" id="qvPrice"></div>
        <p style="font-size:.83rem;color:var(--ash);line-height:1.75;margin-bottom:1rem" id="qvDesc"></p>
        <button class="btn btn-amber btn-full" id="qvAddBtn">Add to Cart</button>
        <button class="btn btn-ghost btn-full btn-sm" style="margin-top:.5rem" id="qvViewBtn">Full Details →</button>
      </div>
    </div>
  </div>
</div>

<!-- ORDER SUCCESS MODAL -->
<div class="modal-wrap" id="orderModal">
  <div class="modal-box" style="text-align:center">
    <div style="font-size:3.5rem;margin-bottom:1rem">🎉</div>
    <h3 style="font-family:var(--ff-d);font-size:1.8rem;margin-bottom:.7rem">Order Placed!</h3>
    <p style="color:var(--ash);margin-bottom:1.8rem;font-size:.88rem;line-height:1.75">Your order is confirmed. Arrival in 3–5 business days.</p>
    <div style="background:var(--ink3);border-radius:8px;padding:.9rem;margin-bottom:1.3rem">
      <div style="color:var(--fog);font-size:.7rem;text-transform:uppercase;letter-spacing:.1em">Reference</div>
      <div style="color:var(--amber);font-size:1.15rem;font-weight:700" id="orderIdDisplay">#LUXE-0000</div>
    </div>
    <button class="btn btn-amber btn-full" onclick="closeModal('orderModal');showPage('home')">Continue Shopping</button>
    <button class="btn btn-ghost btn-full btn-sm" style="margin-top:.5rem" onclick="closeModal('orderModal');showPage('profile')">View Orders</button>
  </div>
</div>

<!-- MOBILE NAV -->
<nav class="mobile-nav" id="mobileNav">
  <button class="mnav-close" onclick="closeMobileNav()">✕</button>
  <a onclick="closeMobileNav();showPage('home');setNavActive('home')">Home</a>
  <a onclick="closeMobileNav();showPage('shop');setNavActive('shop')">Shop</a>
  <a onclick="closeMobileNav();showPage('about');setNavActive('about')">About</a>
  <a onclick="closeMobileNav();showPage('contact');setNavActive('contact')">Contact</a>
  <a onclick="closeMobileNav();showPage('profile')">Account</a>
  <a onclick="closeMobileNav();showPage('checkout')">Checkout</a>
</nav>

<!-- ══════════════════════════════════
     NAVBAR
══════════════════════════════════ -->
<nav class="navbar">
  <div class="nav-logo" onclick="showPage('home');setNavActive('home')">
    LUXE<div class="nav-logo-dot"></div>
  </div>
  <div class="nav-links">
    <span class="nav-link active" id="nl-home" onclick="showPage('home');setNavActive('home')">Home</span>
    <span class="nav-link" id="nl-shop" onclick="showPage('shop');setNavActive('shop')">Shop</span>
    <span class="nav-link" id="nl-about" onclick="showPage('about');setNavActive('about')">About</span>
    <span class="nav-link" id="nl-contact" onclick="showPage('contact');setNavActive('contact')">Contact</span>
  </div>
  <div style="display:flex;align-items:center;gap:0.75rem">
    <div class="nav-search">
      <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="color:var(--fog);flex-shrink:0"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
      <input type="text" id="searchInput" placeholder="Search…" oninput="filterProducts(this.value)" autocomplete="off"/>
    </div>
    <div class="nav-actions">
      <button class="nav-btn" title="Wishlist" onclick="openWishlist()">♡<span class="nav-badge" id="wishBadge" style="display:none">0</span></button>
      <button class="nav-btn" title="Account" onclick="handleAccountClick()">
        <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
      </button>
      <button class="nav-btn" title="Cart" onclick="openCart()">
        <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
        <span class="nav-badge" id="cartBadge">0</span>
      </button>
    </div>
    <button class="hamburger" onclick="openMobileNav()"><span></span><span></span><span></span></button>
  </div>
</nav>

<!-- ══════════════════════════════════
     HOME PAGE
══════════════════════════════════ -->
<div class="page active" id="page-home">

  <!-- Hero -->
  <section class="hero">
    <div class="hero-left">
      <div class="hero-tag"><span class="hero-tag-line"></span>Spring Collection 2025</div>
      <h1>Objects<br/>of Rare<br/><em>Beauty</em></h1>
      <p class="hero-desc">Handpicked luxury goods for those who believe in the quiet power of extraordinary things. Each piece, a story of craft.</p>
      <div class="hero-btns">
        <button class="btn btn-amber" onclick="showPage('shop');setNavActive('shop')">Shop Collection</button>
        <button class="btn btn-ghost" onclick="document.getElementById('categories-section').scrollIntoView({behavior:'smooth'})">Browse Categories</button>
      </div>
      <div class="hero-stats">
        <div><span class="hero-stat-val">50K+</span><span class="hero-stat-lbl">Happy Clients</span></div>
        <div><span class="hero-stat-val">235+</span><span class="hero-stat-lbl">Products</span></div>
        <div><span class="hero-stat-val">4.9★</span><span class="hero-stat-lbl">Avg Rating</span></div>
      </div>
    </div>
    <div class="hero-right">
      <img class="hero-right-img" src="https://picsum.photos/seed/luxe-hero/900/800" alt="Luxury"/>
      <div class="hero-right-vignette"></div>
      <div class="hero-float-card">
        <div class="hfc-label">Featured Piece</div>
        <div class="hfc-name">Gold Luminara Watch</div>
        <div class="hfc-price">From $1,299</div>
        <div class="hfc-badge"><span class="hfc-dot"></span>In Stock</div>
      </div>
    </div>
  </section>

  <!-- Ticker -->
  <div class="ticker" aria-hidden="true">
    <div class="ticker-track">
      <span class="ticker-item">Free Worldwide Shipping</span>
      <span class="ticker-item">Authenticated Products</span>
      <span class="ticker-item">30-Day Returns</span>
      <span class="ticker-item">24/7 Concierge</span>
      <span class="ticker-item">Limited Editions</span>
      <span class="ticker-item">Free Worldwide Shipping</span>
      <span class="ticker-item">Authenticated Products</span>
      <span class="ticker-item">30-Day Returns</span>
      <span class="ticker-item">24/7 Concierge</span>
      <span class="ticker-item">Limited Editions</span>
    </div>
  </div>

  <!-- Categories -->
  <section class="section" id="categories-section">
    <div class="eyebrow">Explore</div>
    <h2 class="section-title">Shop by Category</h2>
    <div class="cat-grid">
      <div class="cat-card" onclick="showPage('shop');setNavActive('shop');setTimeout(function(){filterByCat('Watches')},50)"><span class="cat-icon">⌚</span><div class="cat-name">Watches</div><div class="cat-num">24 pieces</div></div>
      <div class="cat-card" onclick="showPage('shop');setNavActive('shop');setTimeout(function(){filterByCat('Jewelry')},50)"><span class="cat-icon">💎</span><div class="cat-name">Jewelry</div><div class="cat-num">38 pieces</div></div>
      <div class="cat-card" onclick="showPage('shop');setNavActive('shop');setTimeout(function(){filterByCat('Fashion')},50)"><span class="cat-icon">🧥</span><div class="cat-name">Fashion</div><div class="cat-num">52 pieces</div></div>
      <div class="cat-card" onclick="showPage('shop');setNavActive('shop');setTimeout(function(){filterByCat('Electronics')},50)"><span class="cat-icon">📱</span><div class="cat-name">Electronics</div><div class="cat-num">31 pieces</div></div>
      <div class="cat-card" onclick="showPage('shop');setNavActive('shop');setTimeout(function(){filterByCat('Beauty')},50)"><span class="cat-icon">✨</span><div class="cat-name">Beauty</div><div class="cat-num">44 pieces</div></div>
      <div class="cat-card" onclick="showPage('shop');setNavActive('shop');setTimeout(function(){filterByCat('Home')},50)"><span class="cat-icon">🏺</span><div class="cat-name">Home</div><div class="cat-num">27 pieces</div></div>
      <div class="cat-card" onclick="showPage('shop');setNavActive('shop');setTimeout(function(){filterByCat('all')},50)"><span class="cat-icon">◎</span><div class="cat-name">View All</div><div class="cat-num">235 pieces</div></div>
    </div>
  </section>

  <!-- Features -->
  <div class="features-strip">
    <div class="feature-item"><span class="feat-icon">🚚</span><div class="feat-title">Free Shipping</div><div class="feat-desc">Worldwide on all orders</div></div>
    <div class="feature-item"><span class="feat-icon">✅</span><div class="feat-title">Authenticated</div><div class="feat-desc">Every product verified</div></div>
    <div class="feature-item"><span class="feat-icon">↩️</span><div class="feat-title">30-Day Returns</div><div class="feat-desc">Hassle-free guarantee</div></div>
    <div class="feature-item"><span class="feat-icon">🎁</span><div class="feat-title">Luxury Packaging</div><div class="feat-desc">Signature gift box</div></div>
  </div>

  <!-- Editorial -->
  <div class="editorial">
    <div class="ed-img"><img src="https://picsum.photos/seed/editorial-luxe/800/600" alt="Luxury Edit"/></div>
    <div class="ed-content">
      <div class="ed-tag">◆ Limited Archive</div>
      <h2>Up to <em>40% Off</em><br/>The Luxury Edit</h2>
      <p>A rare opportunity to own pieces from our most coveted archive. Each item is authenticated, numbered, and arrives in our signature box.</p>
      <div class="ed-perks">
        <div class="ed-perk"><span class="ed-perk-dot"></span>Complimentary express shipping worldwide</div>
        <div class="ed-perk"><span class="ed-perk-dot"></span>Lifetime authenticity certificate</div>
        <div class="ed-perk"><span class="ed-perk-dot"></span>White-glove packaging & gifting</div>
        <div class="ed-perk"><span class="ed-perk-dot"></span>Personal styling consultation</div>
      </div>
      <button class="btn btn-amber" onclick="showPage('shop');setNavActive('shop')">Shop the Edit</button>
    </div>
  </div>

  <!-- Newsletter -->
  <section class="newsletter">
    <div class="eyebrow" style="justify-content:center;margin-bottom:0.6rem">Inner Circle</div>
    <h2>Join the <em>Inner Circle</em></h2>
    <p class="newsletter-sub">Early access, exclusive drops, and curated edits — direct to your inbox.</p>
    <form class="nl-form" onsubmit="subscribeNewsletter(event)">
      <input type="email" placeholder="your@email.com" required/>
      <button type="submit">Subscribe</button>
    </form>
  </section>

  <!-- Footer -->
  <footer>
    <div class="footer-grid">
      <div class="footer-brand">
        <div class="footer-logo">LUXE</div>
        <p>A curated destination for luxury goods and exceptional craftsmanship. We believe in the beauty of things made to last.</p>
        <div class="socials">
          <a class="social" href="#">📷</a>
          <a class="social" href="#">𝕏</a>
          <a class="social" href="#">P</a>
          <a class="social" href="#">▶</a>
        </div>
      </div>
      <div class="footer-col"><h5>Shop</h5><ul>
        <li><a onclick="showPage('shop');setNavActive('shop')">All Products</a></li>
        <li><a onclick="showPage('shop');setNavActive('shop');setTimeout(function(){filterByCat('Watches')},50)">Watches</a></li>
        <li><a onclick="showPage('shop');setNavActive('shop');setTimeout(function(){filterByCat('Jewelry')},50)">Jewelry</a></li>
        <li><a>Gift Cards</a></li>
      </ul></div>
      <div class="footer-col"><h5>Account</h5><ul>
        <li><a onclick="handleAccountClick()">Sign In</a></li>
        <li><a onclick="showPage('profile')">My Profile</a></li>
        <li><a onclick="showPage('profile');switchProfileTab('orders')">Orders</a></li>
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
      <p>© 2025 LUXE. All rights reserved.</p>
      <p>Privacy · Terms · Cookies</p>
    </div>
  </footer>
</div><!-- end home -->

<!-- ══════════════════════════════════
     SHOP PAGE (Products from DB)
══════════════════════════════════ -->
<div class="page" id="page-shop">

  <div class="shop-hero">
    <div class="shop-hero-inner">
      <div>
        <div class="eyebrow">Curated Collection</div>
        <h1>Our <em>Products</em></h1>
      </div>
      <div class="shop-hero-count">
        Showing <span id="visibleCount"><?= count($all_products) ?></span> of <?= count($all_products) ?> items
      </div>
    </div>
  </div>

  <div class="shop-layout">

    <!-- Sidebar filters -->
    <div class="shop-sidebar">
      <div class="sidebar-section">
        <div class="sidebar-section-head">Categories</div>

        <div class="cat-filter-btn active" id="cfb-all" onclick="filterByCat('all',this)">
          <div class="cfb-left"><div class="cfb-color" style="background:#888"></div><span class="cfb-name">All Products</span></div>
          <span class="cfb-count"><?= count($all_products) ?></span>
        </div>

        <?php
        $cats = [];
        foreach($all_products as $p){ $cats[$p['category']] = ($cats[$p['category']] ?? 0) + 1; }
        $catColors = ['Electronics'=>'#4f8ef7','Watches'=>'#d4a853','Jewelry'=>'#9b72f0','Fashion'=>'#f0922b','Home'=>'#3db87a','Beauty'=>'#c0596a'];
        foreach($cats as $cat => $count):
          $col = $catColors[$cat] ?? '#888';
        ?>
        <div class="cat-filter-btn" id="cfb-<?= htmlspecialchars($cat) ?>" onclick="filterByCat('<?= htmlspecialchars($cat) ?>',this)">
          <div class="cfb-left"><div class="cfb-color" style="background:<?= $col ?>"></div><span class="cfb-name"><?= htmlspecialchars($cat) ?></span></div>
          <span class="cfb-count"><?= $count ?></span>
        </div>
        <?php endforeach; ?>
      </div>

      <div class="sidebar-divider"></div>

      <div class="sort-section">
        <span class="sort-label">Sort By</span>
        <select class="sort-select" id="shopSort" onchange="applySortAndFilter()">
          <option value="default">Default</option>
          <option value="price-asc">Price: Low → High</option>
          <option value="price-desc">Price: High → Low</option>
          <option value="name">Name A–Z</option>
        </select>
      </div>

      <div class="sidebar-divider"></div>

      <div class="sidebar-mini-stat"><span class="sms-label">Total items</span><span class="sms-val"><?= count($all_products) ?></span></div>
      <div class="sidebar-mini-stat"><span class="sms-label">Categories</span><span class="sms-val"><?= count($cats) ?></span></div>
    </div>

    <!-- Products area -->
    <div class="shop-content">
      <div class="shop-toolbar">
        <span class="active-filter-tag" id="activeFilterTag">◆ All Products</span>
        <div class="view-switcher">
          <button class="view-sw-btn active" id="vsGrid" onclick="setView('grid')">⊞ Grid</button>
          <button class="view-sw-btn" id="vsList" onclick="setView('list')">☰ List</button>
        </div>
      </div>

      <div class="products-grid" id="shopGrid">
        <?php foreach($all_products as $row):
          $id    = $row['id'];
          $name  = htmlspecialchars($row['product_name']);
          $cat   = htmlspecialchars($row['category']);
          $price = (float)$row['price'];
          $old   = (!empty($row['old_price']) && $row['old_price'] > 0) ? (float)$row['old_price'] : null;
          $desc  = htmlspecialchars($row['description'] ?? '');
          $filename = basename(str_replace('\\','/',$row['image']));
          $img = 'http://localhost/Ecommerse/backend/uploads/' . $filename;
          $col = $catColors[$row['category']] ?? '#888';
        ?>
        <article class="product-card"
          data-id="<?= $id ?>"
          data-name="<?= $name ?>"
          data-category="<?= $cat ?>"
          data-price="<?= $price ?>"
          data-img="<?= $img ?>"
          data-desc="<?= $desc ?>">

          <span class="pc-badge <?= $old ? 'bdg-sale' : 'bdg-new' ?>"><?= $old ? 'Sale' : 'New' ?></span>

          <div class="pc-img">
            <img src="<?= $img ?>" alt="<?= $name ?>" loading="lazy" onerror="this.src='https://picsum.photos/seed/<?= $id ?>/500/400'"/>
            <div class="pc-overlay">
              <button class="po-btn" onclick="quickView(this.closest('.product-card'))">Quick View</button>
              <button class="po-btn" onclick="addToCartFromCard(this.closest('.product-card'))">Add to Cart</button>
            </div>
          </div>

          <div class="pc-body">
            <div class="pc-cat" style="color:<?= $col ?>"><?= $cat ?></div>
            <div class="pc-name"><?= $name ?></div>
            <div class="pc-stars"><span class="stars">★★★★★</span><span class="stars-n">(0)</span></div>
            <div class="pc-price-row">
              <div class="pc-prices">
                <span class="pc-price">$<?= number_format($price,2) ?></span>
                <?php if($old): ?><span class="pc-old">$<?= number_format($old,2) ?></span><?php endif; ?>
              </div>
              <button class="pc-add" onclick="addToCartFromCard(this.closest('.product-card'))">+</button>
            </div>
          </div>
        </article>
        <?php endforeach; ?>
        <div class="no-results" id="noResults" style="display:none">No products found in this category.</div>
      </div>
    </div>
  </div>
</div><!-- end shop -->

<!-- ══════════════════════════════════
     PRODUCT DETAIL PAGE
══════════════════════════════════ -->
<div class="page" id="page-detail">
  <div class="page-crumb">
    <div class="breadcrumb">
      <span onclick="showPage('home');setNavActive('home')">Home</span>
      <span class="bc-sep">›</span>
      <span onclick="showPage('shop');setNavActive('shop')">Shop</span>
      <span class="bc-sep">›</span>
      <span id="detailBreadcrumb" style="color:var(--snow)">Product</span>
    </div>
  </div>
  <div class="detail-grid">
    <div class="d-gallery">
      <div class="d-main-img"><img id="detailMainImg" src="" alt=""/></div>
      <div class="d-thumbs" id="detailThumbs"></div>
    </div>
    <div class="d-info">
      <div class="d-cat" id="detailCat"></div>
      <h1 class="d-name" id="detailName"></h1>
      <div class="d-rating">
        <span class="stars">★★★★★</span>
        <span class="stars-n" id="detailReviews">(0 reviews)</span>
        <span style="color:var(--teal);font-size:.78rem">● In Stock</span>
      </div>
      <div class="d-price">
        <span class="d-price-now" id="detailPriceNow"></span>
        <span class="d-price-was" id="detailPriceWas"></span>
      </div>
      <p class="d-desc" id="detailDesc"></p>
      <span class="opt-label">Color</span>
      <div class="color-row">
        <div class="c-dot active" style="background:#d4a853" onclick="selectColor(this)"></div>
        <div class="c-dot" style="background:#666" onclick="selectColor(this)"></div>
        <div class="c-dot" style="background:#111" onclick="selectColor(this)"></div>
        <div class="c-dot" style="background:#8B4513" onclick="selectColor(this)"></div>
      </div>
      <span class="opt-label">Size</span>
      <div class="size-row">
        <button class="sz-btn active" onclick="selectSize(this)">XS</button>
        <button class="sz-btn" onclick="selectSize(this)">S</button>
        <button class="sz-btn" onclick="selectSize(this)">M</button>
        <button class="sz-btn" onclick="selectSize(this)">L</button>
        <button class="sz-btn" onclick="selectSize(this)">XL</button>
      </div>
      <div class="qty-row">
        <div class="qty-ctrl">
          <button class="qty-btn" onclick="changeQty(-1)">−</button>
          <input class="qty-val" id="detailQty" value="1" readonly/>
          <button class="qty-btn" onclick="changeQty(1)">+</button>
        </div>
        <span style="font-size:.8rem;color:var(--fog)">Max 10 per order</span>
      </div>
      <div class="d-actions">
        <button class="btn btn-amber" style="flex:2" id="detailAddBtn">Add to Cart</button>
        <button class="wish-btn" onclick="addToWishlistFromDetail()" title="Wishlist">♡</button>
      </div>
      <div class="d-features">
        <div class="d-feat"><span class="d-feat-ic">🚚</span>Free worldwide shipping</div>
        <div class="d-feat"><span class="d-feat-ic">↩️</span>30-day returns</div>
        <div class="d-feat"><span class="d-feat-ic">✅</span>Authenticity guaranteed</div>
        <div class="d-feat"><span class="d-feat-ic">🎁</span>Luxury gift packaging</div>
      </div>
    </div>
  </div>
  <div class="reviews">
    <div class="eyebrow">Reviews</div>
    <h2 class="section-title" style="font-size:1.6rem;margin-bottom:1.5rem">Customer Reviews</h2>
    <div class="review-card"><div class="rev-head"><div><div class="rev-name">Alexandra M.</div><div class="stars" style="font-size:.76rem">★★★★★</div></div><div class="rev-date">Feb 28, 2025</div></div><p class="rev-text">Absolutely stunning quality. The packaging alone was impressive, and the product exceeded every expectation.</p></div>
    <div class="review-card"><div class="rev-head"><div><div class="rev-name">James T.</div><div class="stars" style="font-size:.76rem">★★★★☆</div></div><div class="rev-date">Feb 20, 2025</div></div><p class="rev-text">Great product, fast shipping. Exactly as described. The craftsmanship is exceptional for the price point.</p></div>
    <div class="review-card"><div class="rev-head"><div><div class="rev-name">Sofia R.</div><div class="stars" style="font-size:.76rem">★★★★★</div></div><div class="rev-date">Feb 15, 2025</div></div><p class="rev-text">Bought this as a gift — the recipient was overjoyed. Beautifully packaged and exactly as shown.</p></div>
  </div>
</div>

<!-- ══════════════════════════════════
     PROFILE PAGE
══════════════════════════════════ -->
<div class="page" id="page-profile">
  <div class="page-crumb">
    <div class="breadcrumb"><span onclick="showPage('home');setNavActive('home')">Home</span><span class="bc-sep">›</span><span style="color:var(--snow)">My Account</span></div>
  </div>
  <div class="profile-layout">
    <aside class="profile-sidebar">
      <div class="profile-card">
        <div class="profile-avatar" id="profileAvatar">👤</div>
        <div class="profile-name" id="profileName">Guest User</div>
        <div class="profile-email" id="profileEmail">Not signed in</div>
      </div>
      <nav class="profile-nav">
        <div class="pnav-item active" onclick="switchProfileTab('overview')">📊 Overview</div>
        <div class="pnav-item" onclick="switchProfileTab('orders')">📦 Orders</div>
        <div class="pnav-item" onclick="switchProfileTab('wishlist-p')">♡ Wishlist</div>
        <div class="pnav-item" onclick="switchProfileTab('addresses')">📍 Addresses</div>
        <div class="pnav-item" onclick="switchProfileTab('settings')">⚙️ Settings</div>
        <div class="pnav-item" onclick="doLogout()">🚪 Sign Out</div>
      </nav>
    </aside>
    <div class="profile-content">
      <div class="profile-panel active" id="panel-overview">
        <h2 class="pp-title">Welcome back</h2>
        <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:1rem;margin-bottom:2rem">
          <div style="background:var(--card);border:1px solid var(--rim);border-radius:10px;padding:1.4rem;text-align:center"><div style="font-family:var(--ff-d);font-size:2rem;color:var(--amber)">3</div><div style="font-size:.68rem;letter-spacing:.1em;text-transform:uppercase;color:var(--fog)">Orders</div></div>
          <div style="background:var(--card);border:1px solid var(--rim);border-radius:10px;padding:1.4rem;text-align:center"><div style="font-family:var(--ff-d);font-size:2rem;color:var(--amber)" id="wishCountProfile">0</div><div style="font-size:.68rem;letter-spacing:.1em;text-transform:uppercase;color:var(--fog)">Wishlist</div></div>
          <div style="background:var(--card);border:1px solid var(--rim);border-radius:10px;padding:1.4rem;text-align:center"><div style="font-family:var(--ff-d);font-size:2rem;color:var(--amber)">$2,147</div><div style="font-size:.68rem;letter-spacing:.1em;text-transform:uppercase;color:var(--fog)">Spent</div></div>
        </div>
        <h3 style="font-size:.72rem;letter-spacing:.14em;text-transform:uppercase;color:var(--fog);margin-bottom:0.9rem">Recent Orders</h3>
        <div class="order-row"><div><div class="order-id">#OBS-7821</div><div class="order-name">Luminara Gold Watch</div><div class="order-date">Mar 15, 2025</div></div><span class="order-status st-delivered" style="margin-left:auto;margin-right:1rem">Delivered</span><div class="order-total">$1,299</div></div>
        <div class="order-row"><div><div class="order-id">#OBS-7654</div><div class="order-name">Rose Gold Necklace</div><div class="order-date">Feb 28, 2025</div></div><span class="order-status st-shipped" style="margin-left:auto;margin-right:1rem">Shipped</span><div class="order-total">$799</div></div>
      </div>
      <div class="profile-panel" id="panel-orders">
        <h2 class="pp-title">Order History</h2>
        <div class="order-row"><div><div class="order-id">#OBS-7821</div><div class="order-name">Luminara Gold Watch × 1</div><div class="order-date">Mar 15, 2025</div></div><span class="order-status st-delivered" style="margin-left:auto;margin-right:1rem">Delivered</span><div class="order-total">$1,299</div></div>
        <div class="order-row"><div><div class="order-id">#OBS-7654</div><div class="order-name">Rose Gold Necklace × 1</div><div class="order-date">Feb 28, 2025</div></div><span class="order-status st-shipped" style="margin-left:auto;margin-right:1rem">Shipped</span><div class="order-total">$799</div></div>
        <div class="order-row"><div><div class="order-id">#OBS-7201</div><div class="order-name">Vitamin C Serum × 2</div><div class="order-date">Jan 10, 2025</div></div><span class="order-status st-processing" style="margin-left:auto;margin-right:1rem">Processing</span><div class="order-total">$178</div></div>
      </div>
      <div class="profile-panel" id="panel-wishlist-p">
        <h2 class="pp-title">My Wishlist</h2>
        <div id="profileWishlistContent" style="color:var(--fog);font-size:.9rem">Your wishlist is empty. Browse products and click ♡ to save items.</div>
      </div>
      <div class="profile-panel" id="panel-addresses">
        <h2 class="pp-title">Saved Addresses</h2>
        <div class="addr-card"><div class="addr-lbl">🏠 Home — Default</div><div class="addr-text">Jane Doe<br/>42 Mayfair Lane, Apt 3B<br/>London, W1K 4PL<br/>United Kingdom</div><div class="addr-acts"><button class="addr-btn">Edit</button><button class="addr-btn">Delete</button></div></div>
        <div class="addr-card"><div class="addr-lbl">🏢 Work</div><div class="addr-text">Jane Doe<br/>15 Canary Wharf, Floor 12<br/>London, E14 5AB</div><div class="addr-acts"><button class="addr-btn">Edit</button><button class="addr-btn">Delete</button></div></div>
        <button class="btn btn-ghost btn-sm" style="margin-top:.75rem" onclick="showToast('Coming soon!')">+ Add Address</button>
      </div>
      <div class="profile-panel" id="panel-settings">
        <h2 class="pp-title">Account Settings</h2>
        <div class="info-grid">
          <div class="form-group"><label class="form-label">First Name</label><input class="form-input" type="text" id="settingFirst" value="Jane"/></div>
          <div class="form-group"><label class="form-label">Last Name</label><input class="form-input" type="text" id="settingLast" value="Doe"/></div>
          <div class="form-group"><label class="form-label">Email</label><input class="form-input" type="email" id="settingEmail" value="jane.doe@email.com"/></div>
          <div class="form-group"><label class="form-label">Phone</label><input class="form-input" type="tel" id="settingPhone" value="+44 7911 123456"/></div>
        </div>
        <div class="form-group" style="margin-bottom:1.4rem"><label class="form-label">Current Password</label><input class="form-input" type="password" placeholder="Enter current password"/></div>
        <div class="form-row" style="margin-bottom:1.8rem">
          <div class="form-group"><label class="form-label">New Password</label><input class="form-input" type="password" placeholder="New password"/></div>
          <div class="form-group"><label class="form-label">Confirm</label><input class="form-input" type="password" placeholder="Confirm password"/></div>
        </div>
        <button class="btn btn-amber" onclick="showToast('Settings saved!')">Save Changes</button>
      </div>
    </div>
  </div>
</div>

<!-- ══════════════════════════════════
     ABOUT PAGE
══════════════════════════════════ -->
<div class="page" id="page-about">

  <div class="about-hero">
    <div class="about-hero-inner">
      <div class="about-tag">◆ Our Story</div>
      <h1>Crafting <em>Extraordinary</em><br/>Since 2018</h1>
      <p>LUXE was born from a simple belief — that the objects surrounding us shape the quality of our days. We curate with obsession so you can live with intention.</p>
    </div>
  </div>

  <div class="about-story">
    <div class="about-story-img">
      <img src="https://picsum.photos/seed/about-luxe/700/600" alt="Our Story"/>
      <div class="about-story-img-overlay">
        <div class="asio-year">2018</div>
        <div class="asio-label">Founded in Kathmandu</div>
      </div>
    </div>
    <div class="about-story-text">
      <div class="eyebrow">Who We Are</div>
      <h2>More Than a Store.<br/>A <em>Philosophy</em>.</h2>
      <p>LUXE started as a small curation studio in Kathmandu, Nepal — a team of five people who believed that access to thoughtfully designed goods shouldn't be limited by geography. Every item in our collection is handpicked, tested, and authenticated before it reaches your door.</p>
      <p>We don't chase trends. We seek permanence — pieces that hold their meaning across seasons and years. Our team travels to source directly from artisans, workshops, and makers who share our commitment to enduring quality.</p>
      <p>Today we serve over 50,000 clients worldwide, yet our approach remains unchanged: curate less, curate better.</p>
      <button class="btn btn-amber" onclick="showPage('shop');setNavActive('shop')">Explore the Collection</button>
    </div>
  </div>

  <div class="about-values">
    <div class="eyebrow">What Drives Us</div>
    <h2 class="section-title">Our Core Values</h2>
    <div class="about-values-grid">
      <div class="value-card">
        <span class="value-icon">🔍</span>
        <div class="value-title">Obsessive Curation</div>
        <div class="value-desc">Every product passes a 12-point review before it earns a place in our collection. We reject more than 90% of what we consider.</div>
      </div>
      <div class="value-card">
        <span class="value-icon">✅</span>
        <div class="value-title">Radical Authenticity</div>
        <div class="value-desc">Every item comes with a certificate of authenticity. We work only with verified makers and authorised distributors worldwide.</div>
      </div>
      <div class="value-card">
        <span class="value-icon">♻️</span>
        <div class="value-title">Sustainable Sourcing</div>
        <div class="value-desc">We prioritise artisans who use responsible materials and ethical practices. Beauty should never come at the cost of the planet.</div>
      </div>
      <div class="value-card">
        <span class="value-icon">🤝</span>
        <div class="value-title">Client-First Always</div>
        <div class="value-desc">Our 24/7 concierge, 30-day returns, and lifetime authenticity guarantee aren't policies — they're promises.</div>
      </div>
      <div class="value-card">
        <span class="value-icon">🌏</span>
        <div class="value-title">Global Reach</div>
        <div class="value-desc">From Kathmandu to Tokyo, New York to London — we ship to over 80 countries with complimentary express delivery.</div>
      </div>
      <div class="value-card">
        <span class="value-icon">💎</span>
        <div class="value-title">Timeless Design</div>
        <div class="value-desc">We curate for longevity, not trends. Every piece in our collection is chosen because it will be just as beautiful in ten years.</div>
      </div>
    </div>
  </div>

  <div class="about-team section">
    <div class="eyebrow">The People</div>
    <h2 class="section-title">Meet Our Team</h2>
    <div class="about-team-grid">
      <div class="team-card">
        <div class="team-avatar" style="background:rgba(212,168,83,0.15);border-color:rgba(212,168,83,0.4)">KM</div>
        <div class="team-name">Krijan Maharjan</div>
        <div class="team-role">Backend & Database</div>
        <div class="team-stat">📞 9813638784</div>
      </div>
      <div class="team-card">
        <div class="team-avatar" style="background:rgba(79,142,247,0.12);border-color:rgba(79,142,247,0.3)">B</div>
        <div class="team-name">Basant</div>
        <div class="team-role">Frontend Developer</div>
        <div class="team-stat">Building beautiful interfaces</div>
      </div>
      <div class="team-card">
        <div class="team-avatar" style="background:rgba(63,168,154,0.12);border-color:rgba(63,168,154,0.3)">P</div>
        <div class="team-name">Prakash</div>
        <div class="team-role">Frontend Developer</div>
        <div class="team-stat">Crafting user experiences</div>
      </div>
      <div class="team-card">
        <div class="team-avatar" style="background:rgba(155,114,240,0.12);border-color:rgba(155,114,240,0.3)">Pb</div>
        <div class="team-name">Prabej</div>
        <div class="team-role">Frontend Developer</div>
        <div class="team-stat">Designing for delight</div>
      </div>
      <div class="team-card">
        <div class="team-avatar" style="background:rgba(192,89,106,0.12);border-color:rgba(192,89,106,0.3)">B</div>
        <div class="team-name">Biraj</div>
        <div class="team-role">Frontend Developer</div>
        <div class="team-stat">Pixel-perfect every time</div>
      </div>
    </div>
  </div>

  <div class="about-numbers">
    <div><div class="an-val">2018</div><div class="an-lbl">Founded</div></div>
    <div><div class="an-val">50K+</div><div class="an-lbl">Happy Clients</div></div>
    <div><div class="an-val">80+</div><div class="an-lbl">Countries Served</div></div>
    <div><div class="an-val">4.9★</div><div class="an-lbl">Avg. Rating</div></div>
  </div>

</div><!-- end about -->

<!-- ══════════════════════════════════
     CONTACT PAGE
══════════════════════════════════ -->
<div class="page" id="page-contact">

  <div class="contact-hero">
    <div class="eyebrow">Get in Touch</div>
    <h1>Let's <em>Talk</em></h1>
    <p>Whether you have a question about a product, need styling advice, or just want to say hello — our team is always here for you.</p>
  </div>

  <div class="contact-layout">

    <!-- Left: info + team -->
    <div>
      <div class="contact-info">
        <h2>Reach Us Directly</h2>
        <p>Our team is based in Kathmandu, Nepal and available across time zones. Pick a channel that works best for you.</p>

        <div class="contact-detail-row">
          <div class="cdr-icon">📍</div>
          <div><div class="cdr-label">Address</div><div class="cdr-value">Kathmandu, Bagmati Province, Nepal</div></div>
        </div>
        <div class="contact-detail-row">
          <div class="cdr-icon">✉️</div>
          <div><div class="cdr-label">Email</div><div class="cdr-value">krijanmaharjan31@gmail.com</div></div>
        </div>
        <div class="contact-detail-row">
          <div class="cdr-icon">⏰</div>
          <div><div class="cdr-label">Working Hours</div><div class="cdr-value">Sunday – Friday, 9:00 AM – 6:00 PM NPT</div></div>
        </div>
      </div>

      <div class="team-section-title">Development Team</div>

      <!-- Krijan — with phone -->
      <div class="member-card">
        <div class="mc-avatar" style="background:rgba(212,168,83,0.15);border-color:rgba(212,168,83,0.4);color:var(--amber)">KM</div>
        <div class="mc-info">
          <div class="mc-name">Krijan Maharjan</div>
          <div class="mc-role">Backend &amp; Database</div>
          <div class="mc-phone">9813638784</div>
        </div>
        <div class="mc-badge">Backend Lead</div>
      </div>

      <!-- Basant -->
      <div class="member-card">
        <div class="mc-avatar" style="background:rgba(79,142,247,0.12);border-color:rgba(79,142,247,0.3);color:#7ab0fa">B</div>
        <div class="mc-info">
          <div class="mc-name">Basant</div>
          <div class="mc-role">Frontend Developer</div>
          <div class="mc-phone">Contact via office</div>
        </div>
        <div class="mc-badge">Frontend</div>
      </div>

      <!-- Prakash -->
      <div class="member-card">
        <div class="mc-avatar" style="background:rgba(63,168,154,0.12);border-color:rgba(63,168,154,0.3);color:#3fa89a">P</div>
        <div class="mc-info">
          <div class="mc-name">Prakash</div>
          <div class="mc-role">Frontend Developer</div>
          <div class="mc-phone">Contact via office</div>
        </div>
        <div class="mc-badge">Frontend</div>
      </div>

      <!-- Prabej -->
      <div class="member-card">
        <div class="mc-avatar" style="background:rgba(155,114,240,0.12);border-color:rgba(155,114,240,0.3);color:#9b72f0">Pb</div>
        <div class="mc-info">
          <div class="mc-name">Prabej</div>
          <div class="mc-role">Frontend Developer</div>
          <div class="mc-phone">Contact via office</div>
        </div>
        <div class="mc-badge">Frontend</div>
      </div>

      <!-- Biraj -->
      <div class="member-card">
        <div class="mc-avatar" style="background:rgba(192,89,106,0.12);border-color:rgba(192,89,106,0.3);color:#c0596a">Bi</div>
        <div class="mc-info">
          <div class="mc-name">Biraj</div>
          <div class="mc-role">Frontend Developer</div>
          <div class="mc-phone">Contact via office</div>
        </div>
        <div class="mc-badge">Frontend</div>
      </div>

    </div><!-- end left -->

    <!-- Right: contact form -->
    <div>
      <div class="contact-form-box">
        <h2>Send a Message</h2>
        <p>Fill in the form below and we'll get back to you within 24 hours.</p>
        <form onsubmit="submitContactForm(event)">
          <div class="form-row" style="margin-bottom:1rem">
            <div class="form-group"><label class="form-label">First Name</label><input class="form-input" type="text" id="cfFirst" placeholder="Jane"/></div>
            <div class="form-group"><label class="form-label">Last Name</label><input class="form-input" type="text" id="cfLast" placeholder="Doe"/></div>
          </div>
          <div class="form-group" style="margin-bottom:1rem"><label class="form-label">Email Address</label><input class="form-input" type="email" id="cfEmail" placeholder="you@email.com"/></div>
          <div class="form-group" style="margin-bottom:1rem"><label class="form-label">Subject</label>
            <select class="form-input" id="cfSubject">
              <option value="">Select a subject…</option>
              <option>Product Enquiry</option>
              <option>Order Status</option>
              <option>Returns &amp; Refunds</option>
              <option>Shipping Information</option>
              <option>Wholesale / Partnerships</option>
              <option>General Enquiry</option>
            </select>
          </div>
          <div class="form-group" style="margin-bottom:1.5rem"><label class="form-label">Message</label><textarea class="cf-textarea" id="cfMessage" placeholder="Tell us how we can help you…"></textarea></div>
          <button type="submit" class="btn btn-amber btn-full">Send Message →</button>
        </form>

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:0.75rem;margin-top:1.5rem;padding-top:1.5rem;border-top:1px solid var(--rim)">
          <div style="background:var(--ink3);border:1px solid var(--rim);border-radius:10px;padding:1rem;text-align:center">
            <div style="font-size:1.4rem;margin-bottom:0.4rem">💬</div>
            <div style="font-size:0.76rem;font-weight:600;margin-bottom:0.2rem">Live Chat</div>
            <div style="font-size:0.72rem;color:var(--fog)">Available 9am–6pm</div>
          </div>
          <div style="background:var(--ink3);border:1px solid var(--rim);border-radius:10px;padding:1rem;text-align:center">
            <div style="font-size:1.4rem;margin-bottom:0.4rem">📞</div>
            <div style="font-size:0.76rem;font-weight:600;margin-bottom:0.2rem">Phone Support</div>
            <div style="font-size:0.72rem;color:var(--fog)">+977 9813638784</div>
          </div>
        </div>
      </div>
    </div>

  </div><!-- end contact-layout -->

  <div class="map-strip">
    <div class="eyebrow">Where We Are</div>
    <h2>Find Us in Kathmandu</h2>
    <p>Visit our showroom or reach out to schedule a private viewing.</p>
    <div class="map-placeholder">
      <div class="map-placeholder-icon">🗺️</div>
      <div>Kathmandu, Bagmati Province, Nepal</div>
      <div style="font-size:0.78rem;color:var(--fog)">Interactive map — open in Google Maps</div>
      <button class="btn btn-ghost btn-sm" onclick="window.open('https://maps.google.com/?q=Kathmandu,Nepal','_blank')">Open in Maps →</button>
    </div>
  </div>

</div><!-- end contact -->

<!-- ══════════════════════════════════
     CHECKOUT PAGE
══════════════════════════════════ -->
<div class="page" id="page-checkout">
  <div class="page-crumb">
    <div class="breadcrumb">
      <span onclick="showPage('home');setNavActive('home')">Home</span><span class="bc-sep">›</span>
      <span onclick="openCart()">Cart</span><span class="bc-sep">›</span>
      <span style="color:var(--snow)">Checkout</span>
    </div>
  </div>
  <div class="checkout-layout">
    <div>
      <form method="POST" action="backend/order_detail.php" onsubmit="injectCartItems()">
        <input type="hidden" name="cart_items" id="cartItemsInput"/>
        <input type="hidden" name="cart_amount" id="cartAmountInput"/>
        <div class="co-box">
          <div class="co-box-title">Contact Information</div>
          <div class="form-row">
            <div class="form-group"><label class="form-label">First Name *</label><input class="form-input" id="coFirst" name="first_name" placeholder="Jane"/></div>
            <div class="form-group"><label class="form-label">Last Name *</label><input class="form-input" id="coLast" name="last_name" placeholder="Doe"/></div>
          </div>
          <div class="form-row">
            <div class="form-group"><label class="form-label">Email *</label><input class="form-input" id="coEmail" name="email" type="email" placeholder="jane@email.com"/></div>
            <div class="form-group"><label class="form-label">Phone *</label><input class="form-input" id="coPhone" name="phone" type="tel" placeholder="+44 7911 000000"/></div>
          </div>
        </div>
        <div class="co-box">
          <div class="co-box-title">Shipping Address</div>
          <div class="form-group"><label class="form-label">Street Address *</label><input class="form-input" id="coAddr" name="street_address" placeholder="42 Mayfair Lane"/></div>
          <div class="form-row">
            <div class="form-group"><label class="form-label">City *</label><input class="form-input" id="coCity" name="city" placeholder="London"/></div>
            <div class="form-group"><label class="form-label">ZIP / Postcode *</label><input class="form-input" id="coZip" name="zip" placeholder="W1K 4PL"/></div>
          </div>
          <div class="form-group"><label class="form-label">Country</label>
            <select class="form-input" name="country" id="coCountry">
              <option>United Kingdom</option><option>United States</option><option>Canada</option><option>Australia</option><option>Germany</option><option>France</option><option>Nepal</option><option>Japan</option><option>China</option>
            </select>
          </div>
          <div class="form-group"><label class="form-label">Notes (Optional)</label><input class="form-input" id="coNotes" placeholder="Leave at door…"/></div>
        </div>
        <div class="co-box">
          <div class="co-box-title">Payment Method</div>
          <div class="pay-opts">
            <div class="pay-opt selected" onclick="selectPayment(this)"><input type="radio" name="pay" checked/> 💳 Credit / Debit Card</div>
            <div class="pay-opt" onclick="selectPayment(this)"><input type="radio" name="pay"/> 📱 PayPal</div>
            <div class="pay-opt" onclick="selectPayment(this)"><input type="radio" name="pay"/> 🏦 Bank Transfer</div>
            <div class="pay-opt" onclick="selectPayment(this)"><input type="radio" name="pay"/> 💵 Cash on Delivery</div>
          </div>
        </div>
        <button type="submit" class="btn btn-amber btn-full" style="padding:1rem">🔒 Place Order Securely</button>
      </form>
    </div>
    <div>
      <div class="co-summary">
        <div class="co-sum-title">Order Summary</div>
        <div id="checkoutItems"><p style="color:var(--fog);font-size:.85rem">No items. <span style="color:var(--amber);cursor:pointer" onclick="showPage('shop')">Shop →</span></p></div>
        <div id="checkoutTotals"></div>
      </div>
    </div>
  </div>
</div>

<div class="toast-wrap" id="toastWrap"></div>

<!-- ══════════════════════════════════
     JAVASCRIPT
══════════════════════════════════ -->
<script>
var cartItems=[];var cartTotal=0;var wishItems=[];var currentUser=null;var currentDetailProduct=null;
var currentCat='all';var currentSort='default';var currentView='grid';

/* ── NAV ACTIVE ── */
function setNavActive(id){
  document.querySelectorAll('.nav-link').forEach(function(n){n.classList.remove('active')});
  var el=document.getElementById('nl-'+id);
  if(el)el.classList.add('active');
}

/* ── PAGES ── */
function showPage(id){
  document.querySelectorAll('.page').forEach(function(p){p.classList.remove('active')});
  var pg=document.getElementById('page-'+id);
  if(pg){pg.classList.add('active');window.scrollTo({top:0,behavior:'smooth'})}
  if(id==='checkout')renderCheckoutSummary();
  if(id==='profile')renderProfileWishlist();
}

/* ── MOBILE NAV ── */
function openMobileNav(){document.getElementById('mobileNav').classList.add('open')}
function closeMobileNav(){document.getElementById('mobileNav').classList.remove('open')}

/* ── DRAWERS ── */
function openCart(){document.getElementById('cartDrawer').classList.add('open');document.getElementById('overlayBg').classList.add('open')}
function openWishlist(){document.getElementById('wishDrawer').classList.add('open');document.getElementById('overlayBg').classList.add('open')}
function closeAllDrawers(){document.getElementById('cartDrawer').classList.remove('open');document.getElementById('wishDrawer').classList.remove('open');document.getElementById('overlayBg').classList.remove('open')}

/* ── MODALS ── */
function openModal(id){document.getElementById(id).classList.add('open')}
function closeModal(id){document.getElementById(id).classList.remove('open')}
document.querySelectorAll('.modal-wrap').forEach(function(m){m.addEventListener('click',function(e){if(e.target===this)this.classList.remove('open')})});

/* ── AUTH ── */
function handleAccountClick(){if(currentUser){showPage('profile')}else{openModal('authModal')}}
function switchAuthTab(tab){
  document.querySelectorAll('.auth-tab').forEach(function(t,i){t.classList.toggle('active',(i===0&&tab==='login')||(i===1&&tab==='register'))});
  document.getElementById('loginPanel').classList.toggle('active',tab==='login');
  document.getElementById('registerPanel').classList.toggle('active',tab==='register');
}
function doLogin(){
  var email=document.getElementById('loginEmail').value.trim();
  var pass=document.getElementById('loginPass').value;
  if(!email||!pass){showToast('Please fill in all fields','error');return}
  if(pass.length<6){showToast('Password too short','error');return}
  currentUser={name:email.split('@')[0],email:email};
  updateProfileUI();closeModal('authModal');showToast('Welcome back, '+currentUser.name+'!');
}
function doSocialLogin(p){currentUser={name:p+' User',email:'user@'+p.toLowerCase()+'.com'};updateProfileUI();closeModal('authModal');showToast('Signed in with '+p+'!')}
function doLogout(){currentUser=null;updateProfileUI();showPage('home');setNavActive('home');showToast('Signed out successfully')}
function updateProfileUI(){
  var name=currentUser?currentUser.name:'Guest User';
  var email=currentUser?currentUser.email:'Not signed in';
  document.getElementById('profileName').textContent=name;
  document.getElementById('profileEmail').textContent=email;
  document.getElementById('profileAvatar').textContent=currentUser?currentUser.name[0].toUpperCase():'👤';
  if(currentUser){document.getElementById('settingFirst').value=name.split(' ')[0]||'';document.getElementById('settingEmail').value=email}
}

/* ── PROFILE TABS ── */
function switchProfileTab(tab){
  document.querySelectorAll('.pnav-item').forEach(function(i){i.classList.remove('active')});
  document.querySelectorAll('.profile-panel').forEach(function(p){p.classList.remove('active')});
  var map={overview:0,orders:1,'wishlist-p':2,addresses:3,settings:4};
  var items=document.querySelectorAll('.pnav-item');
  if(map[tab]!==undefined)items[map[tab]].classList.add('active');
  var panel=document.getElementById('panel-'+tab);
  if(panel)panel.classList.add('active');
  if(tab==='wishlist-p')renderProfileWishlist();
}

/* ── CART ── */
function addToCartFromCard(card){addToCart(card.dataset.name,parseInt(card.dataset.price),card.dataset.img)}
function addToCart(name,price,img){
  var ex=cartItems.find(function(i){return i.name===name});
  if(ex){ex.qty++}else{cartItems.push({name:name,price:price,img:img,qty:1})}
  cartTotal+=price;updateCartUI();showToast('✓ '+name+' added');openCart();
}
function removeFromCart(name,price){
  var idx=cartItems.findIndex(function(i){return i.name===name});
  if(idx>-1){cartTotal-=price*cartItems[idx].qty;cartItems.splice(idx,1);updateCartUI()}
}
function updateCartUI(){
  var qty=cartItems.reduce(function(s,i){return s+i.qty},0);
  document.getElementById('cartBadge').textContent=qty;
  document.getElementById('cartCountLabel').textContent='('+qty+')';
  document.getElementById('cartTotalAmt').textContent='$'+cartTotal.toLocaleString();
  var empty=cartItems.length===0;
  document.getElementById('cartEmpty').style.display=empty?'flex':'none';
  document.getElementById('cartItemsList').style.display=empty?'none':'block';
  document.getElementById('cartFooter').style.display=empty?'none':'block';
  document.getElementById('cartItemsList').innerHTML=cartItems.map(function(item){
    return '<div class="cart-item"><div class="ci-img"><img src="'+item.img+'" alt="'+item.name+'"/></div>'+
      '<div class="ci-info"><div class="ci-name">'+item.name+(item.qty>1?' ×'+item.qty:'')+'</div>'+
      '<div class="ci-price">$'+(item.price*item.qty).toLocaleString()+'</div></div>'+
      '<button class="ci-rm" onclick="removeFromCart(\''+item.name+'\','+item.price+')">✕</button></div>';
  }).join('');
}

/* ── WISHLIST ── */
function addToWishlist(name,price,img){
  if(wishItems.find(function(i){return i.name===name})){showToast(name+' already in wishlist');return}
  wishItems.push({name:name,price:price,img:img});updateWishUI();showToast('♡ Saved: '+name);
}
function removeFromWishlist(name){wishItems=wishItems.filter(function(i){return i.name!==name});updateWishUI();renderProfileWishlist()}
function moveWishToCart(name){var item=wishItems.find(function(i){return i.name===name});if(item){addToCart(item.name,item.price,item.img);removeFromWishlist(name)}}
function updateWishUI(){
  var qty=wishItems.length;
  var badge=document.getElementById('wishBadge');badge.textContent=qty;badge.style.display=qty>0?'flex':'none';
  document.getElementById('wishCountLabel').textContent='('+qty+')';
  var empty=wishItems.length===0;
  document.getElementById('wishEmpty').style.display=empty?'flex':'none';
  document.getElementById('wishItemsList').style.display=empty?'none':'block';
  document.getElementById('wishCountProfile').textContent=qty;
  document.getElementById('wishItemsList').innerHTML=wishItems.map(function(item){
    return '<div class="wish-item"><div class="wi-img"><img src="'+item.img+'" alt="'+item.name+'"/></div>'+
      '<div class="wi-info"><div class="wi-name">'+item.name+'</div><div class="wi-price">$'+item.price.toLocaleString()+'</div></div>'+
      '<div class="wi-acts"><button class="wi-add" onclick="moveWishToCart(\''+item.name+'\')">Add to Cart</button>'+
      '<button class="wi-rm" onclick="removeFromWishlist(\''+item.name+'\')">✕ Remove</button></div></div>';
  }).join('');
}
function renderProfileWishlist(){
  var c=document.getElementById('profileWishlistContent');if(!c)return;
  if(wishItems.length===0){c.innerHTML='<p style="color:var(--fog)">Wishlist empty. Click ♡ on any product.</p>';return}
  c.innerHTML=wishItems.map(function(item){
    return '<div class="wish-item" style="background:var(--card);border:1px solid var(--rim);border-radius:10px;padding:1rem;margin-bottom:.6rem">'+
      '<div class="wi-img"><img src="'+item.img+'" alt="'+item.name+'"/></div>'+
      '<div class="wi-info"><div class="wi-name">'+item.name+'</div><div class="wi-price">$'+item.price.toLocaleString()+'</div></div>'+
      '<div class="wi-acts"><button class="wi-add" onclick="moveWishToCart(\''+item.name+'\')">Cart</button>'+
      '<button class="wi-rm" onclick="removeFromWishlist(\''+item.name+'\');renderProfileWishlist()">✕</button></div></div>';
  }).join('');
}

/* ── QUICK VIEW ── */
function quickView(card){
  document.getElementById('qvName').textContent=card.dataset.name;
  document.getElementById('qvCat').textContent=card.dataset.category;
  document.getElementById('qvPrice').textContent='$'+parseInt(card.dataset.price).toLocaleString();
  document.getElementById('qvImg').src=card.dataset.img;
  document.getElementById('qvDesc').textContent=card.dataset.desc;
  document.getElementById('qvAddBtn').onclick=function(){addToCart(card.dataset.name,parseInt(card.dataset.price),card.dataset.img);closeModal('quickViewModal')};
  document.getElementById('qvViewBtn').onclick=function(){closeModal('quickViewModal');openDetailPage(card)};
  openModal('quickViewModal');
}

/* ── DETAIL PAGE ── */
function openDetailPage(card){
  currentDetailProduct={name:card.dataset.name,cat:card.dataset.category,price:parseInt(card.dataset.price),img:card.dataset.img,desc:card.dataset.desc,id:card.dataset.id};
  document.getElementById('detailBreadcrumb').textContent=currentDetailProduct.name;
  document.getElementById('detailCat').textContent=currentDetailProduct.cat;
  document.getElementById('detailName').textContent=currentDetailProduct.name;
  document.getElementById('detailPriceNow').textContent='$'+currentDetailProduct.price.toLocaleString();
  document.getElementById('detailDesc').textContent=currentDetailProduct.desc;
  document.getElementById('detailMainImg').src=currentDetailProduct.img;
  document.getElementById('detailReviews').textContent='('+(Math.floor(Math.random()*900)+50)+' reviews)';
  document.getElementById('detailPriceWas').textContent='';
  document.getElementById('detailQty').value=1;
  document.getElementById('detailAddBtn').onclick=function(){
    var qty=parseInt(document.getElementById('detailQty').value);
    for(var i=0;i<qty;i++)addToCart(currentDetailProduct.name,currentDetailProduct.price,currentDetailProduct.img);
  };
  document.getElementById('detailThumbs').innerHTML=[1,2,3,4].map(function(i){
    return '<div class="d-thumb '+(i===1?'active':'')+'" onclick="setDetailThumb(this,\''+currentDetailProduct.img+'\')"><img src="'+currentDetailProduct.img+'" alt="View '+i+'"/></div>';
  }).join('');
  showPage('detail');
}
function injectCartItems(){
  document.getElementById('cartItemsInput').value=cartItems.map(function(i){return i.name+' ×'+i.qty}).join(', ');
  document.getElementById('cartAmountInput').value=cartItems.reduce(function(s,i){return s+(i.price*i.qty)},0);
}
function addToWishlistFromDetail(){if(!currentDetailProduct)return;addToWishlist(currentDetailProduct.name,currentDetailProduct.price,currentDetailProduct.img)}
function setDetailThumb(el,url){document.querySelectorAll('.d-thumb').forEach(function(t){t.classList.remove('active')});el.classList.add('active');document.getElementById('detailMainImg').src=url}
function changeQty(d){var inp=document.getElementById('detailQty');inp.value=Math.max(1,Math.min(10,parseInt(inp.value)+d))}
function selectColor(dot){document.querySelectorAll('.c-dot').forEach(function(d){d.classList.remove('active')});dot.classList.add('active')}
function selectSize(btn){document.querySelectorAll('.sz-btn').forEach(function(b){b.classList.remove('active')});btn.classList.add('active')}

/* ── SHOP FILTER & SORT ── */
function filterByCat(cat,el){
  currentCat=cat;
  document.querySelectorAll('.cat-filter-btn').forEach(function(b){b.classList.remove('active')});
  if(el){el.classList.add('active')}else{
    var btn=document.getElementById('cfb-'+cat);
    if(btn)btn.classList.add('active');
  }
  var tag=document.getElementById('activeFilterTag');
  if(tag)tag.textContent='◆ '+(cat==='all'?'All Products':cat);
  applySortAndFilter();
}

function applySortAndFilter(){
  var cards=Array.from(document.querySelectorAll('#shopGrid .product-card'));
  var sort=document.getElementById('shopSort')?document.getElementById('shopSort').value:'default';
  currentSort=sort;
  var visible=[];
  cards.forEach(function(c){
    var match=currentCat==='all'||c.dataset.category===currentCat;
    c.classList.toggle('hidden',!match);
    if(match)visible.push(c);
  });
  var container=document.getElementById('shopGrid');
  if(sort!=='default'){
    visible.sort(function(a,b){
      if(sort==='price-asc')return parseFloat(a.dataset.price)-parseFloat(b.dataset.price);
      if(sort==='price-desc')return parseFloat(b.dataset.price)-parseFloat(a.dataset.price);
      if(sort==='name')return a.dataset.name.localeCompare(b.dataset.name);
      return 0;
    });
    visible.forEach(function(c){container.appendChild(c)});
  }
  var nr=document.getElementById('noResults');
  if(nr)nr.style.display=visible.length===0?'block':'none';
  var vc=document.getElementById('visibleCount');
  if(vc)vc.textContent=visible.length;
}

function filterProducts(q){
  var cards=document.querySelectorAll('#shopGrid .product-card');
  var lower=q.toLowerCase().trim();var visible=0;
  cards.forEach(function(c){
    var match=!lower||c.dataset.name.toLowerCase().includes(lower)||c.dataset.category.toLowerCase().includes(lower);
    c.classList.toggle('hidden',!match);if(match)visible++;
  });
  var nr=document.getElementById('noResults');
  if(nr)nr.style.display=visible===0&&lower?'block':'none';
  var vc=document.getElementById('visibleCount');
  if(vc)vc.textContent=visible;
  if(lower){showPage('shop');setNavActive('shop')}
}

function setView(v){
  currentView=v;
  var grid=document.getElementById('shopGrid');
  document.getElementById('vsGrid').classList.toggle('active',v==='grid');
  document.getElementById('vsList').classList.toggle('active',v==='list');
  if(v==='list'){grid.classList.add('list-view')}else{grid.classList.remove('list-view')}
}

/* ── CHECKOUT ── */
function renderCheckoutSummary(){
  var sub=cartItems.reduce(function(s,i){return s+i.price*i.qty},0);
  var shipping=sub>=100?0:15;var tax=Math.round(sub*0.08);var total=sub+shipping+tax;
  document.getElementById('checkoutItems').innerHTML=cartItems.length===0
    ?'<p style="color:var(--fog);font-size:.85rem">No items. <span style="color:var(--amber);cursor:pointer" onclick="showPage(\'shop\')">Shop →</span></p>'
    :cartItems.map(function(item){return'<div class="sum-item"><div class="sum-item-img"><img src="'+item.img+'" alt="'+item.name+'"/></div><div class="sum-item-info">'+item.name+(item.qty>1?' ×'+item.qty:'')+'</div><div class="sum-item-price">$'+(item.price*item.qty).toLocaleString()+'</div></div>'}).join('');
  document.getElementById('checkoutTotals').innerHTML=
    '<div class="sum-row"><span class="lbl">Subtotal</span><span>$'+sub.toLocaleString()+'</span></div>'+
    '<div class="sum-row"><span class="lbl">Shipping</span><span>'+(shipping===0?'<span style="color:var(--teal)">Free</span>':'$'+shipping)+'</span></div>'+
    '<div class="sum-row"><span class="lbl">Tax (8%)</span><span>$'+tax+'</span></div>'+
    '<div class="sum-row total"><span class="lbl">Total</span><span class="val">$'+total.toLocaleString()+'</span></div>';
}
function selectPayment(el){document.querySelectorAll('.pay-opt').forEach(function(o){o.classList.remove('selected');o.querySelector('input').checked=false});el.classList.add('selected');el.querySelector('input').checked=true}

/* ── NEWSLETTER ── */
function subscribeNewsletter(e){e.preventDefault();e.target.querySelector('input').value='';showToast('✓ Welcome to the inner circle!')}

/* ── CONTACT FORM ── */
function submitContactForm(e){
  e.preventDefault();
  var first=document.getElementById('cfFirst').value.trim();
  var email=document.getElementById('cfEmail').value.trim();
  var msg=document.getElementById('cfMessage').value.trim();
  if(!first||!email||!msg){showToast('Please fill in all required fields','error');return}
  document.getElementById('cfFirst').value='';
  document.getElementById('cfLast').value='';
  document.getElementById('cfEmail').value='';
  document.getElementById('cfSubject').value='';
  document.getElementById('cfMessage').value='';
  showToast('✓ Message sent! We\'ll reply within 24 hours.');
}

/* ── TOAST ── */
function showToast(msg,type){
  var wrap=document.getElementById('toastWrap');
  var t=document.createElement('div');
  t.className='toast'+(type==='error'?' error':'');
  t.innerHTML='<span class="toast-msg">'+msg+'</span>';
  wrap.appendChild(t);
  setTimeout(function(){t.style.opacity='0';t.style.transform='translateX(30px)';t.style.transition='all .3s ease';setTimeout(function(){t.remove()},300)},2800);
}

/* ── KEYBOARD ── */
document.addEventListener('keydown',function(e){
  if(e.key==='Escape'){closeAllDrawers();closeMobileNav();document.querySelectorAll('.modal-wrap').forEach(function(m){m.classList.remove('open')})}
});
// Show login success / error from PHP redirect
(function() {
    var params = new URLSearchParams(window.location.search);
    if (params.get('login') === 'success') {
        var name = '<?php echo isset($_SESSION["fullname"]) ? addslashes($_SESSION["fullname"]) : "" ?>';
        if (name) {
            currentUser = {
                name: name,
                email: '<?php echo isset($_SESSION["email"]) ? addslashes($_SESSION["email"]) : "" ?>'
            };
            updateProfileUI();
            showToast('Welcome back, ' + name + '!');
        }
    }
    if (params.get('error')) {
        showToast(decodeURIComponent(params.get('error')), 'error');
        openModal('authModal');
    }
})();
</script>
</body>
</html>