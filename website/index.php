<?php
declare(strict_types=1);

$products = [
    ['name' => 'Arc Desk Lamp', 'type' => 'Lighting', 'price' => '₩89,000', 'tone' => 'sand', 'shape' => 'lamp', 'label' => 'BEST SELLER'],
    ['name' => 'Forma Ceramic Vase', 'type' => 'Objects', 'price' => '₩54,000', 'tone' => 'peach', 'shape' => 'vase', 'label' => 'NEW'],
    ['name' => 'Noon Lounge Chair', 'type' => 'Furniture', 'price' => '₩329,000', 'tone' => 'sage', 'shape' => 'chair', 'label' => 'LIMITED'],
    ['name' => 'Still Life Print', 'type' => 'Art', 'price' => '₩42,000', 'tone' => 'blue', 'shape' => 'frame', 'label' => 'CURATED'],
];

$q = trim((string) ($_GET['q'] ?? ''));
$shown = array_values(array_filter($products, static function (array $item) use ($q): bool {
    return $q === '' || stripos($item['name'] . ' ' . $item['type'], $q) !== false;
}));

function e(string $value): string {
    return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}
?><!doctype html>
<html lang="ko">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <meta name="theme-color" content="#f5f3ee">
  <title>Onda Living — Make room for better days</title>
  <link rel="stylesheet" href="/style.css">
</head>
<body>
  <div class="announcement">새로운 공간을 위한 첫 주문 · 5만원 이상 무료 배송 <span>↗</span></div>
  <header class="site-header">
    <a class="logo" href="/" aria-label="Onda Living home"><span class="logo-mark">◒</span> onda<span class="logo-light">living</span></a>
    <nav aria-label="메인 메뉴"><a href="#shop">Shop</a><a href="#story">Our story</a><a href="#notes">Journal</a></nav>
    <div class="header-actions"><a href="#shop" class="text-link">컬렉션 보기 <span>↗</span></a><span class="bag">Bag <b>0</b></span></div>
  </header>

  <main>
    <section class="hero">
      <div class="hero-copy"><div class="eyebrow"><span class="dot"></span> THOUGHTFUL OBJECTS FOR EVERYDAY LIFE</div>
        <h1>일상에 머무는<br><em>좋은 감각.</em></h1>
        <p>오래 곁에 두고 싶은 가구와 오브제. 익숙한 하루에 새로운 여백을 만들어 보세요.</p>
        <a class="button" href="#shop">컬렉션 둘러보기 <span>↗</span></a>
        <div class="hero-meta"><span>01 / 04</span><span class="line"></span><span>THE SPRING EDIT</span></div>
      </div>
      <div class="hero-art" role="img" aria-label="따뜻한 톤의 의자와 조명이 있는 거실 일러스트">
        <div class="sun"></div><div class="arch"></div><div class="floor"></div><div class="art-chair"><div class="chair-back"></div><div class="chair-seat"></div><div class="chair-leg leg-one"></div><div class="chair-leg leg-two"></div></div><div class="art-lamp"><div class="lamp-shade"></div><div class="lamp-stem"></div><div class="lamp-base"></div></div><div class="side-table"></div><div class="vase"></div>
        <div class="hero-art-caption">ONDA INTERIOR / VOL. 01</div>
      </div>
    </section>

    <section class="promise"><span>✳ 오래 쓰는 좋은 소재</span><span>◌ 매일을 위한 디자인</span><span>↗ 당신의 공간까지 안전하게</span></section>

    <section class="collection section-wrap" id="shop">
      <div class="section-heading"><div><div class="eyebrow">THE COLLECTION</div><h2>공간을 바꾸는 작은 선택</h2><p>소재와 형태에 집중해 고른 이번 시즌의 아이템.</p></div><span class="count"><?= count($products) ?> OBJECTS / 2026</span></div>
      <form class="search" action="/" method="get" role="search"><label for="q">Find something for your space</label><div><input id="q" name="q" value="<?= e($q) ?>" placeholder="제품이나 카테고리 검색" maxlength="80"><button type="submit" aria-label="검색">↗</button></div></form>
      <div class="products">
        <?php foreach ($shown as $item): ?>
        <article class="product"><div class="product-art <?= e($item['tone']) ?>"><span class="tag"><?= e($item['label']) ?></span><div class="object <?= e($item['shape']) ?>"></div><span class="art-index">ONDA / <?= e(strtoupper($item['type'])) ?></span></div><div class="product-meta"><div><small><?= e($item['type']) ?></small><h3><?= e($item['name']) ?></h3></div><span><?= e($item['price']) ?></span></div></article>
        <?php endforeach; ?>
        <?php if ($shown === []): ?><p class="empty">“<?= e($q) ?>”에 맞는 제품이 없습니다. 다른 검색어를 입력해 주세요.</p><?php endif; ?>
      </div>
    </section>

    <section class="story" id="story"><div class="story-visual"><div class="story-circle"></div><div class="story-block"></div><span>FORM, FUNCTION & FEELING</span></div><div class="story-copy"><div class="eyebrow">OUR POINT OF VIEW</div><h2>좋은 공간은<br>좋은 하루를 만듭니다.</h2><p>우리는 특별한 날보다 평범한 순간을 생각합니다. 손이 자주 닿는 것, 눈길이 오래 머무는 것. 그렇게 일상에 자연스럽게 스며드는 디자인을 소개합니다.</p><a href="#notes" class="under-link">Onda의 이야기 읽기 <span>↗</span></a></div></section>
    <section class="notes section-wrap" id="notes"><div class="eyebrow">THE JOURNAL</div><h2>생활의 기록</h2><div class="note-grid"><article><span>01 / INTERVIEW</span><h3>머무르고 싶은 집을 만드는 방법</h3><p>조금 덜어내고, 정말 좋아하는 것들로 채우는 이야기.</p></article><article><span>02 / MATERIAL</span><h3>시간이 지날수록 좋아지는 소재</h3><p>오래 사용할수록 깊이를 더하는 소재를 소개합니다.</p></article><article><span>03 / INSPIRATION</span><h3>햇빛이 드는 오후의 공간</h3><p>빛과 그림자만으로도 달라지는 집의 표정.</p></article></div></section>
  </main>
  <footer><div><a class="logo" href="/"><span class="logo-mark">◒</span> onda<span class="logo-light">living</span></a><p>Objects for a better everyday.</p></div><div class="footer-links"><a href="#shop">Shop</a><a href="#story">About</a><a href="#notes">Journal</a></div><span>© 2026 Onda Living. Demo storefront.</span></footer>
</body>
</html>
