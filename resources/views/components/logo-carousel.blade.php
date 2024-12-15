<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        background: #f2f2f2;
        height: 50px;
    }

    .logos-slide img {
        height: 20px;
    }

    .logos {
        overflow: hidden;
        white-space: nowrap;
    }

    .logos {
        overflow: hidden;
        white-space: nowrap;
        padding: 60px 0;
        background-color: #FFFFFF;
    }
    .logos-slide img {
        height: 20px;
        margin: 0 20px;
    }

    @keyframes slide {
        from {
            transform: translateX(0);
        }
        to {
            transform: translateX(-100%);
        }
    }
    .logos-slide {
        animation: 35s slide infinite linear;
    }

    .logos-slide {
        display: inline-block;
        animation: 35s slide infinite linear;
    }
</style>
<div class="logos">
    <div class="logos-slide">
{{--        Precisa adicionar as imagens--}}
    </div>
</div>
