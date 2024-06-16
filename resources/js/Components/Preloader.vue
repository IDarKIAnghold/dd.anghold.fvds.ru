<!-- Preloader.vue -->
<template>
    <div id="nprogress" style="transition: all 200ms linear 0s; opacity: 0;">
        <div class="bar" role="bar" style="transform: translate3d(0%, 0px, 0px); transition: all 200ms ease 0s;">
            <div class="peg"></div>
        </div>
    </div>
</template>

<style>
.spinner {
    border: 16px solid #f3f3f3;
    border-top: 16px solid #3498db;
    border-radius: 50%;
    width: 120px;
    height: 120px;
    animation: spin 2s linear infinite;
}

@keyframes spin {
    0% {
        transform: rotate(0deg);
    }

    100% {
        transform: rotate(360deg);
    }
}
</style>
