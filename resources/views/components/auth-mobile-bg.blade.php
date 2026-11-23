<style>
    .mobile-bg-anim {
        position: absolute;
        inset: 0;
        overflow: hidden;
        z-index: 0;
        pointer-events: none;
        background: #1a1a18;
    }
    .prof-grid-bg {
        background-color: #1a1a18;
        background-size: 28px 28px;
    }
    .prof-stars { position:absolute; inset:0; pointer-events:none; }
    .prof-stars span {
        position:absolute; width:2px; height:2px; border-radius:50%;
        background:#ffffff !important; opacity: 0.3;
    }
    @media (min-width: 1024px) {
        .mobile-bg-anim { display: none !important; }
    }
</style>

<div class="mobile-bg-anim">
    <div class="absolute inset-0 prof-grid-bg pointer-events-none"></div>
    <div class="prof-stars">
        @for($i=0;$i<18;$i++)
        <span style="top:{{ rand(2,90) }}%; left:{{ rand(2,98) }}%;"></span>
        @endfor
    </div>
</div>
