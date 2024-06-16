<script setup lang="js">
import { Link } from '@inertiajs/vue3';
</script>
<template>
    <div class="container" id="footer">
        <div class="row footer-row">
            <div class="col-sm-12 col-md-6">
                <h6>About</h6>
                <p class="text-justify">
                    # <i>Lorem ipsum dolor sit amet. </i> Lorem ipsum dolor sit amet
                    consectetur
                    adipisicing elit. Fugiat, eius minima! Iste doloremque, nisi nam, exercitationem
                    reprehenderit
                    recusandae necessitatibus laboriosam sint cupiditate incidunt eaque iure blanditiis error
                    ipsa
                    earum laborum dolor temporibus sunt nemo hic. Molestias, est aliquid minima qui ipsum
                    adipisci,
                    modi vel veniam laboriosam similique ullam vero praesentium cumque iusto iure.
                </p>
            </div>

            <div class="col-xs-6 col-md-3">
                <h6>Категории</h6>
                <ul class="footer-links">
                    <li>
                        <Link :href="'/category/guitars'">Гитары</Link>
                    </li>
                    <li>
                        <Link :href="'/category/guitar_equipment'">Гитарное оборудование </Link>
                    </li>
                    <li>
                        <Link :href="'/category/accessories'">Аксессуары</Link>
                    </li>
                </ul>
            </div>

            <div class="col-xs-6 col-md-3">
                <h6>Ссылки</h6>
                <ul class="footer-links">
                </ul>
            </div>
        </div>
        <hr>
        <div class="col-md-4 col-sm-6 col-xs-12">
            <ul class="social-icons">
                <li>
                    <a class="Vk" href="https://vk.com/dd.Anghold">
                        <i class="fa-brands fa-vk"></i>
                    </a>
                </li>
                <li>
                    <a class="Vk" href="https://t.me/Anghold">
                        <i class="fa-brands fa-telegram"></i>
                    </a>
                </li>
                <li>
                    <Link class="About" :href="route('about')">
                    <i class="fa-solid fa-address-card"></i>
                    </Link>
                </li>
            </ul>
        </div>
    </div>
</template>
<style lang="scss">
.site-footer {
    left: 0;
    bottom: 0;
    width: 100%;
    background-color: #26272b;
    padding: 45px 0 20px;
    font-size: 15px;
    line-height: 24px;
    color: #737373;

    .footer-row {
        background-color: #26272b;
    }

    hr {
        border-top-color: #bbb;
        opacity: 0.5;
    }

    h6 {
        color: #fff;
        font-size: 16px;
        text-transform: uppercase;
        margin-top: 5px;
        letter-spacing: 2px;
    }

    a {
        color: #737373;

        &:hover {
            color: #3366cc;
            text-decoration: none;
        }
    }

    &.footer-links {
        padding-left: 0;
        list-style: none;

        li {
            display: block;

            a {
                color: #737373;

                &:active,
                &:focus,
                &:hover {
                    color: #3366cc;
                    text-decoration: none;
                }
            }
        }

        &.inline {
            li {
                display: inline-block;
            }
        }
    }

    .social-icons {
        text-align: right;

        a {
            width: 40px;
            height: 40px;
            line-height: 40px;
            margin-left: 6px;
            margin-right: 0;
            border-radius: 100%;
            background-color: #33353d;

            &:hover {
                color: #fff;
                background-color: #29aafe;
            }
        }

        &.size-sm {
            a {
                line-height: 34px;
                height: 34px;
                width: 34px;
                font-size: 14px;
            }
        }

        li {
            display: inline-block;
            margin-bottom: 4px;

            &.title {
                margin-right: 15px;
                text-transform: uppercase;
                color: #96a2b2;
                font-weight: 700;
                font-size: 13px;
            }
        }

        a {
            color: #818a91;
            font-size: 16px;
            display: inline-block;
            line-height: 44px;
            width: 44px;
            height: 44px;
            text-align: center;
            margin-right: 8px;
            border-radius: 100%;
            -webkit-transition: all .2s linear;
            -o-transition: all .2s linear;
            transition: all .2s linear;

            &.facebook:hover {
                background-color: #3b5998;
            }

            &.twitter:hover {
                background-color: #00aced;
            }

            &.linkedin:hover {
                background-color: #007bb6;
            }

            &.dribbble:hover {
                background-color: #ea4c89;
            }
        }
    }
}
</style>
