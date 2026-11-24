<?php /* Yo-Ji · Anasayfa açılış popup'ı — her ziyaretçiye, her girişte gösterilir. */ ?>
<!-- ============================================================
     YO-JI · Açılış popup'ı (her ziyaretçiye, her girişte)
     Kullanım: Bu bloğun tamamını footer.php içinde </body>'den
     hemen ÖNCE yapıştırın. Görseli yükleyin ve YJ_POPUP_IMG yolunu
     kendi görsel adresinizle değiştirin.
     ============================================================ -->
<div id="yj-popup" class="yj-popup" role="dialog" aria-modal="true" aria-label="Yo-Ji yakında 3 şehirde açılıyor" hidden>
  <div class="yj-popup__backdrop" data-yj-close></div>
  <div class="yj-popup__box">
    <button type="button" class="yj-popup__close" data-yj-close aria-label="Kapat">&times;</button>
    <a class="yj-popup__link" href="/locations.php">
      <img src="/img/popup.jpg"
           alt="Yo-Ji yakında açılıyor: İstanbul Caddebostan, İzmir Balçova, Adana Seyhan"
           class="yj-popup__img" width="1024" height="1606">
    </a>
  </div>
</div>

<style>
  .yj-popup{position:fixed;inset:0;z-index:99999;display:flex;align-items:center;justify-content:center;padding:20px}
  .yj-popup[hidden]{display:none}
  .yj-popup__backdrop{position:absolute;inset:0;background:rgba(30,20,25,.72);backdrop-filter:blur(3px);animation:yjFade .3s ease}
  .yj-popup__box{position:relative;z-index:1;max-width:min(92vw,480px);width:100%;animation:yjPop .35s cubic-bezier(.2,.9,.3,1.2)}
  .yj-popup__link{display:block;line-height:0}
  .yj-popup__img{width:100%;height:auto;border-radius:18px;box-shadow:0 20px 60px rgba(0,0,0,.4);display:block}
  .yj-popup__close{position:absolute;top:-14px;right:-14px;width:40px;height:40px;border:0;border-radius:50%;
    background:#fff;color:#1d1a1a;font-size:26px;line-height:38px;text-align:center;cursor:pointer;
    box-shadow:0 4px 14px rgba(0,0,0,.25);z-index:2;transition:transform .15s}
  .yj-popup__close:hover{transform:scale(1.08)}
  @keyframes yjFade{from{opacity:0}to{opacity:1}}
  @keyframes yjPop{from{opacity:0;transform:scale(.9) translateY(10px)}to{opacity:1;transform:none}}
  @media(max-width:520px){.yj-popup__close{top:-10px;right:-10px;width:36px;height:36px;font-size:24px;line-height:34px}}
  @media(prefers-reduced-motion:reduce){.yj-popup__backdrop,.yj-popup__box{animation:none}}
  body.yj-popup-open{overflow:hidden}
</style>

<script>
(function () {
  var pop = document.getElementById('yj-popup');
  if (!pop) return;

  function open() {
    pop.hidden = false;
    document.body.classList.add('yj-popup-open');
    document.addEventListener('keydown', onKey);
  }
  function close() {
    pop.hidden = true;
    document.body.classList.remove('yj-popup-open');
    document.removeEventListener('keydown', onKey);
  }
  function onKey(e) { if (e.key === 'Escape') close(); }

  /* Kapat düğmesine, çarpıya ve arka plana tıklayınca kapan (görsele tıklayınca kapanmaz, linke gider) */
  pop.querySelectorAll('[data-yj-close]').forEach(function (el) {
    el.addEventListener('click', close);
  });

  /* Her girişte göster. Sayfa açılır açılmaz göstermek için setTimeout'u 0 yapabilir,
     ya da birkaç saniye beklemek için 1500 gibi bir değer verebilirsiniz. */
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', function () { setTimeout(open, 600); });
  } else {
    setTimeout(open, 600);
  }
})();
</script>
<!-- ======================= YO-JI popup sonu ======================= -->
