@if ( !empty($yandexMetrika = $counters['yandexMetrika']) )
@php
$yandexMetrika = array_unique($yandexMetrika, SORT_REGULAR)
@endphp
@foreach($yandexMetrika as $count => $numCounter)
<!-- Yandex.Metrika counter #{{ $count }}-->
<script type="text/javascript">
(function(m, e, t, r, i, k, a) {
    m[i] = m[i] || function() {
        (m[i].a = m[i].a || []).push(arguments)
    };
    m[i].l = 1 * new Date();
    k = e.createElement(t), a = e.getElementsByTagName(t)[0], k.async = 1, k.src = r, a.parentNode.insertBefore(k,
        a)
})
(window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

ym({
    {
        $numCounter
    }
}, "init", {
    clickmap: true,
    trackLinks: true,
    accurateTrackBounce: true,
    webvisor: true
});
</script>
<noscript>
    <div><img src="https://mc.yandex.ru/watch/{{ $numCounter }}" style="position:absolute; left:-9999px;" alt="" />
    </div>
</noscript>
<!-- /Yandex.Metrika counter -->
@endforeach
@endif

<!-- /Callibri counter -->
<script src="//cdn.callibri.ru/callibri.js" type="text/javascript" charset="utf-8"></script>