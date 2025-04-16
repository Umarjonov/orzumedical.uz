<!DOCTYPE html>
<html lang="{{ App::getLocale('locale') }}">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>{{ config('app.name', 'Dashboard') }}</title>
    <!-- Favicon -->
    <link href="{{ asset('uploads/img/favicon_black.png') }}" rel="icon" type="image/png">
    <link href="{{ asset('assets/css/output.css') }}" rel="stylesheet">
    <!-- TailwindCSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <!-- Google Fonts: Nano Sans -->
    <link href="{{ asset('argon/css/fonts.googleapis.css') }}" rel="stylesheet">
{{--    <link rel="preconnect" href="https://fonts.googleapis.com">--}}
{{--    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>--}}
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Noto+Sans:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif:wght@600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400&display=swap" rel="stylesheet">

    <style>
        .noto-sans {
            font-family: "Noto Sans", sans-serif;
        }

        .noto-serif {
            font-family: "Noto Serif", serif;
        }

        .inter {
            font-family: "Inter", sans-serif;
        }
        .scrolled {
            transform: translateY(-100px);
        }
        body{
            background-color: #24282d;
        }
        .modal_loading {
            display:    none;
            position:   fixed;
            z-index:    1000;
            top:        0;
            left:       0;
            height:     100%;
            width:      100%;
            background: rgba( 255, 255, 255, .8 )
            url({{asset('uploads/FhHRx.gif')}})
            50% 50%
            no-repeat;
        }

        /* When the body has the loading class, we turn
           the scrollbar off with overflow:hidden */
        body.loading .modal_loading {
            overflow: hidden;
        }

        /* Anytime the body has the loading class, our
           modal element will be visible */
        body.loading .modal_loading {
            display: block;
        }
        button.active{
            background-color: #338038 !important;
            color: #fff !important;
        }
    </style>
</head>

<body class="bg-[#F8F9FE] relative">
<!-- Header -->
<section>
    <header class="fixed w-full z-50  bg-[#4A9F50] text-white py-[14px] text-sm block lg:hidden">
        <div class="max-w-7xl mx-auto flex flex-wrap items-center justify-between px-4">
            <!-- Left Side: Mobile Menu Button -->
            <button id="menu-toggle"
                    class="lg:hidden w-10 h-10 flex items-center justify-center bg-gray-100 rounded-lg">
                <i class="fas fa-bars text-black text-lg"></i>
            </button>

            <!-- Center: Logo -->
            <a href="#" class="flex items-center justify-center">
                <img src="{{ asset('uploads/img/logo-nav.svg') }}" alt="Orzu Medical Logo" class="w-[120px]" />
            </a>
            <div class="gap-2 flex">
                <!-- Right Side: Mobile Phone Button -->
                <a href='tel:@Lang("base.tel1")'
                   class="lg:hidden w-10 h-10 flex items-center justify-center bg-gray-100 rounded-lg">
                    <i class="fas fa-phone-alt text-black text-lg"></i>
                </a>
                <!-- Button -->
                <a href="#aloqa"
                   class="lg:hidden w-10 h-10 flex items-center justify-center bg-gray-100 rounded-lg">
                    <i class="fas fa-solid fa-address-card  text-black text-lg"></i>
                </a>
            </div>
        </div>
    </header>

    <header class="bg-[#4A9F50] text-white py-[14px] mb-[150px] text-sm hidden lg:block">
        <div class="max-w-6xl mx-auto flex items-center justify-between px-4">
            <!-- Chap tomon: Location va Email -->
            <div class="flex items-center space-x-12 inter">
    {{--            <!-- Location -->--}}
    {{--            <a href="#"--}}
    {{--               class="relative flex items-center space-x-2   hover:opacity-80 after:content-[''] after:block after:w-0 after:h-[2px] after:bg-white after:transition-all after:duration-300 after:absolute after:bottom-[-2px] after:left-0 hover:after:w-full">--}}
    {{--                <i class="fas fa-map-marker-alt"></i>--}}
    {{--                <span>Toshkent viloyati</span>--}}
    {{--            </a>--}}

                <!-- Email -->
                <a href="mailto:orzumedical.uz@gmail.com"
                   class="relative flex items-center space-x-2 hover:opacity-80 after:content-[''] after:block after:w-0 after:h-[2px] after:bg-white after:transition-all after:duration-300 after:absolute after:bottom-[-2px] after:left-0 hover:after:w-full">
                    <i class="fas fa-envelope"></i>
                    <span>@Lang("base.email")</span>
                </a>

                <!-- Telegram -->
                <a href="https://t.me/orzu_medical"
                   class="relative flex items-center space-x-2 hover:opacity-80 after:content-[''] after:block after:w-0 after:h-[2px] after:bg-white after:transition-all after:duration-300 after:absolute after:bottom-[-2px] after:left-0 hover:after:w-full">
                    <i class="fab fa-telegram-plane text-xl"></i>
                    <span>@Lang("base.telegram")</span>
                </a>

                <!-- WhatsApp -->
                <a href="#"
                   class="relative flex items-center space-x-2 hover:opacity-80 after:content-[''] after:block after:w-0 after:h-[2px] after:bg-white after:transition-all after:duration-300 after:absolute after:bottom-[-2px] after:left-0 hover:after:w-full">
                    <i class="fab fa-whatsapp text-xl"></i>
                    <span>@Lang("base.WhatsApp")</span>
                </a>
            </div>
            <!-- Til o'zgartirish -->
            <div class="hidden lg:flex items-center space-x-6">
                <a href="/language/uz" class="lang-btn {{ App::getLocale('locale')=='uz' ? 'bg-white text-[#4A9F50]' : '' }} hover:opacity-80 px-2 py-1 rounded">
                    <img src="{{ asset('uploads/img/uz.svg') }}" alt="UZ" class="w-8 h-6">
                </a>
                <a href="/language/ru" class="lang-btn {{ App::getLocale('locale')=='ru' ? 'bg-white text-[#4A9F50]' : '' }} hover:opacity-80 px-2 py-1 rounded">
                    <img src="{{ asset('uploads/img/ru.svg') }}" alt="RU" class="w-8 h-6">
                </a>
            </div>
        </div>
    </header>

    <div class="modal_loading"><!-- Place at bottom of page --></div>
    <!-- Desktop Menu -->
    <div class="flex justify-center">
        <nav class="bg-white z-50 top-0 fixed max-w-6xl mx-auto shadow-sm rounded-lg transition-transform duration-500  mt-[100px] px-7 hidden lg:block" id="navbar">
            <div class="w-full py-[15.5px]  flex items-center justify-between nano-sans">
                <!-- Logotip -->
                <a href="/" class="text-xl font-bold text-[#4A9F50]">
                    <img src="{{ asset('uploads/img/logo-nav.svg') }}" alt="Logo icon">
                </a>

                <!-- Menu bo'limlari -->
                <div class="w-full flex gap-[8px]">
                    <ul class="flex items-center space-x-[25px] text-nowrap ml-[60px]">
                        <li><a href="#orzu-medical" class="text-black hover:text-[#4A9F50] text-base scroll-link">@Lang("base.orzu_medical")</a></li>
                        <li><a href="#about" class="text-black hover:text-[#4A9F50] text-base scroll-link">@Lang("base.our_us")</a>
                        </li>
                        <li><a href="#filiallar" class="text-black hover:text-[#4A9F50] text-base scroll-link">@Lang('base.branch')</a>
                        </li>
                        <li><a href="#xizmatlar" class="text-black hover:text-[#4A9F50] text-base scroll-link">@lang("base.services")</a>
                        </li>
                        <li><a href="#aloqa" class="text-black hover:text-[#4A9F50] text-base scroll-link">@Lang("base.contact")</a></li>
                    </ul>

                    <!-- Telefon raqami va Button -->
                    <div class="flex items-center space-x-[40px] ml-auto">
                        <!-- Telefon -->
                        <div class="flex flex-col items-left">
                            <a href='tel:@Lang("base.tel1")'>
                                <i class="fas fa-phone-alt text-black"></i>
                                <span class=" text-lg text-black">@Lang("base.tel1")</span>
                            </a>
                            <a href='tel:@Lang("base.tel3")'>
                                <i class="fas fa-phone-alt text-black"></i>
                                <span class=" text-lg text-black">@Lang("base.tel3")</span>
                            </a>
                        </div>

                        <!-- Button -->
                        <a href="#aloqa"
                           class="text-lg bg-[#4A9F50] text-white py-[10px] px-[20px] rounded-[10px] hover:bg-[#3e8a41]">
                            @Lang('base.enrollment')
                        </a>
                    </div>
                </div>
            </div>
        </nav>
    </div>
    <!-- Mobile Menu (Hidden by default) -->
    <nav id="mobile-menu" class="lg:hidden hidden w-full h-screen overflow-hidden z-20 bg-white py-6">
        <ul class="flex flex-col items-start space-y-5 px-6">
            <li><a href="#orzu-medical" class="text-black text-lg hover:text-[#4A9F50] scroll-link">@Lang("base.orzu_medical")</a>
            </li>
            <li><a href="#about" class="text-black text-lg hover:text-[#4A9F50] scroll-link">@Lang("base.our_us")</a></li>
            <li><a href="#filiallar" class="text-black text-lg hover:text-[#4A9F50] scroll-link">@Lang("base.branch")</a></li>
            <li><a href="#xizmatlar" class="text-black text-lg hover:text-[#4A9F50] scroll-link">@Lang("base.services")</a></li>
            <li><a href="#aloqa" class="text-black text-lg hover:text-[#4A9F50] scroll-link">@Lang("base.contact")</a></li>
        </ul>

        <div class="relative h-[250px]">
            <div class="mt-8 bg-[#4A9F50] py-4 flex justify-around items-center absolute w-full bottom-0">
                <a href="https://t.me/orzu_medical" class="flex items-center space-x-2 text-white hover:opacity-80">
                    <i class="fab fa-telegram-plane text-lg"></i>
                    <span>@Lang('base.telegram')</span>
                </a>
                <a href="#" class="flex items-center space-x-2 text-white hover:opacity-80">
                    <i class="fab fa-whatsapp text-lg"></i>
                    <span>@Lang('base.WhatsApp')</span>
                </a>
            </div>
        </div>

        <div class="flex justify-around items-center py-4 bg-white">
            <a href="/language/uz" class="lang-btn {{ App::getLocale('locale')=='uz' ? 'border' : '' }} border-gray-300 px-2 py-1 rounded">
                <img src="{{ asset('uploads/img/uz.png') }}" alt="UZ" class="w-8 h-6" />
            </a>
            <a href="/language/ru" class="lang-btn {{ App::getLocale('locale')=='ru' ? 'border' : '' }} border-gray-300 px-2 py-1 rounded">
                <img src="{{ asset('uploads/img/ru.png') }}" alt="RU" class="w-8 h-6" />
            </a>
        </div>
    </nav>
</section>

<!-- Mobile menu toggle , Tushunarli bolishi uchun shu yerga yozildi -->
<script>
    const menuToggle = document.getElementById('menu-toggle');
    const mobileMenu = document.getElementById('mobile-menu');

    menuToggle.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden')
    });
</script>


<!-- About -->
<section class="max-w-6xl mx-auto flex flex-col lg:flex-row items-center justify-between mt-[19px] pb-[100px] px-4">
    <!-- Left Side (Mobileda tepada)-->
{{--    <div--}}
{{--        class="relative mt-10 w-full w-[328px] md:w-[497px] h-[295.27px] md:h-[447px] rounded-[20px] overflow-visible mb-12">--}}
        <!-- Odam rasmi no-bg -->
        <img src="{{ asset('uploads/img/rasm1.jpg')}}" alt="Odam rasmi"
             class="relative mt-10 w-full w-[328px] md:w-[497px] h-[270px] md:h-[250px] rounded-[20px] overflow-visible mb-12">
{{--    </div>--}}

    <!-- Right Side Text -->
    <div class="w-full lg:w-[544px]">
        <h1 class="nano-sans text-[#E74C3C] text-sm sm:text-base lg:text-lg font-medium leading-5 mb-4">
            @lang('base.text2')
        </h1>
        <p class="nano-sans text-gray-800 text-[24px] sm:text-[32px] lg:text-[40px] leading-[32px] sm:leading-[40px] lg:leading-[48px] font-semibold mb-5">
            @Lang('base.text3')
        </p>
        <p class="nano-sans text-sm sm:text-base text-black leading-[22px] sm:leading-[24px]">
            @Lang('base.text4')
        </p>
        <p class="nano-sans text-[18px] font-bold text-black leading-[22px] sm:leading-[24px]">
            @Lang('base.text51')
        </p>
    </div>
</section>

<!-- Klinika -->
<section id="orzu-medical" class="bg-white w-full">
    <div class="max-w-6xl mx-auto bg-white pt-[94px] pb-[100px] px-4">
        <h1
            class="nano-serif font-semibold text-[32px] sm:text-[36px] lg:text-[40px] leading-[42px] sm:leading-[48px] lg:leading-[54.48px] mb-[44px]">
            @Lang('base.text5')
        </h1>

        <div class="flex flex-col lg:flex-row items-center gap-8 lg:gap-[150px]">
            <img class="w-full max-w-[386px] h-auto mb-6 lg:mb-0 hidden md:block rounded-[20px]" src="{{ asset('uploads/img/rasm2.jpg')}}"
                 alt="Orzu medical humans" />

            <section class="w-full">
                <div class="space-y-[38px]">
                    <div class="flex items-start gap-4">
                        <img class="w-10 h-10" src="{{ asset('uploads/img/heard.svg') }}" alt="Battery icon" />
                        <div class="max-w-[322px]">
                            <h3 class="nano-sans font-semibold text-xl leading-[27.24px] text-[#000000]">@Lang('base.Diagnostics')
                            </h3>
                            <p class="nano-sans text-base leading-[21.79px]">@Lang('base.text6')</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <img class="w-10 h-10" src="{{ asset('uploads/img/heard.svg') }}" alt="Heart icon" />
                        <div class="max-w-[322px]">
                            <h3 class="nano-sans font-semibold text-xl leading-[27.24px] text-[#000000]">@Lang('base.Cleansing')
                            </h3>
                            <p class="nano-sans text-base leading-[21.79px]">@Lang("base.text7")</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <img class="w-10 h-10" src="{{ asset('uploads/img/heard.svg') }}" alt="Nurse icon" />
                        <div class="max-w-[322px]">
                            <h3 class="nano-sans font-semibold text-xl leading-[27.24px] text-[#000000]">@Lang('base.text8')</h3>
                            <p class="nano-sans text-base leading-[21.79px]">@Lang('base.text9')</p>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <div class="flex flex-col lg:flex-row items-center mt-[64px]">
            <section class="w-full lg:w-[57%]">
                <div class="space-y-[38px]">
                    <div class="flex items-start gap-4">
                        <img class="w-10 h-10" src="{{ asset('uploads/img/heard.svg') }}" alt="Hot meal icon" />
                        <div class="max-w-[322px]">
                            <h3 class="nano-sans font-semibold text-xl leading-[27.24px] text-[#000000]">@Lang("base.Healthy_eating")</h3>
                            <p class="nano-sans text-base leading-[21.79px]">@Lang("base.text10")</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <img class="w-10 h-10" src="{{ asset('uploads/img/heard.svg') }}" alt="Medical symbol icon" />
                        <div class="max-w-[322px]">
                            <h3 class="nano-sans font-semibold text-xl leading-[27.24px] text-[#000000]">@Lang('base.text11')</h3>
                            <p class="nano-sans text-base leading-[21.79px]">@Lang('base.text12')</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <img class="w-10 h-10" src="{{ asset('uploads/img/heard.svg') }}" alt="Hospital symbol icon" />
                        <div class="max-w-[322px]">
                            <h3 class="nano-sans font-semibold text-xl leading-[27.24px] text-[#000000]">@lang("base.text13")</h3>
                            <p class="nano-sans text-base leading-[21.79px]">@Lang("base.text14")</p>
                        </div>
                    </div>
                </div>
            </section>

            <img class="w-full max-w-[386px] h-auto hidden md:block rounded-[20px]" src="{{ asset('uploads/img/rasm3.jpg')}}"
                 alt="Orzu medical 2" />
        </div>
    </div>
</section>



<!-- Advantages -->
<section class="max-w-6xl mx-auto pt-[94px] pb-[100px] px-4">
    <h1 class="noto-serif font-semibold text-[32px] sm:text-[36px] lg:text-[40px] leading-[42px] sm:leading-[48px] lg:leading-[54.48px] mb-6">
        @lang("base.Advantages")
    </h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        <div class="mr-[20px] lg:mr-[40px]">
            <h3 class="nano-sans font-medium text-[24px] sm:text-[26px] lg:text-[28px] leading-[32px] sm:leading-[36px] lg:leading-[38.14px] mb-2">
                @Lang("base.text15")
            </h3>
            <p class="nano-sans text-lg sm:text-xl text-[#979797] leading-[24px] sm:leading-[26px] lg:leading-[27.24px]">
                @Lang("base.text16")
            </p>
        </div>

        <div class="mr-[20px] lg:mr-[40px]">
            <h3
                class="nano-sans font-medium text-[24px] sm:text-[26px] lg:text-[28px] leading-[32px] sm:leading-[36px] lg:leading-[38.14px] mb-2">
                @Lang("base.Treatment")
            </h3>
            <p
                class="nano-sans text-lg sm:text-xl text-[#979797] leading-[24px] sm:leading-[26px] lg:leading-[27.24px]">
                @Lang("base.text17")
            </p>
        </div>

        <div class="mr-[20px] lg:mr-[40px]">
            <h3
                class="nano-sans font-medium text-[24px] sm:text-[26px] lg:text-[28px] leading-[32px] sm:leading-[36px] lg:leading-[38.14px] mb-2">
                @Lang("base.text18")
            </h3>
            <p
                class="nano-sans text-lg sm:text-xl text-[#979797] leading-[24px] sm:leading-[26px] lg:leading-[27.24px]">
                @Lang("base.text19")
            </p>
        </div>
    </div>
</section>

<!-- ------------------Biz Haqimizda start ------------------------ -->
<div id="about" class="bg-[#ffffff] pt-[70px] pb-[100px]">
    <section class="max-w-7xl mx-auto p-6 bg-white">
        <h3 class="font-black noto-serif text-[32px] mt-[56px] mb-6">@Lang("base.text41")</h3>
{{--        <p class="noto-sans font-medium text-[20px] leading-[27.24px] mb-11">@Lang("base.text15")Bemorlarimiz qoldirgan fikr muloxazalar--}}
        </p>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($videos as $video)
                <div>
                    <div class="rounded-lg overflow-hidden shadow-lg aspect-video">
                        <iframe class="w-full h-[258px]" src="{{ $video->url }}"
                                title='@Lang("base.videos.$video->id.title")'
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen></iframe>
                    </div>
                    <p class="noto-serif text-black  text-2xl font-bold leading-[33px] ml-2 mt-4">@Lang("base.videos.$video->id.title")</p>
{{--                    <p class="text-[#979797] nano-sans text-base font-bold leading-[22px] ml-2">Lorem ipsum</p>--}}
                </div>
            @endforeach
        </div>
    </section>
</div>

<!-- ------------------Biz Haqimizda end ------------------------ -->

<!-- Aloqa section -->
<div id="aloqa" class="max-w-7xl mx-auto items-center pb-[100px] p-6">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
        <!-- Chap Info  -->
        <div class="space-y-6">
            <p class="noto-sans text-[#E7373C] font-bold uppercase mb-[20px]">@Lang("base.contact")</p>
            <h2 class="noto-serif text-3xl font-semibold leading-snug mb-[44px]">
                @Lang("base.text34")
            </h2>
            <p class="noto-sans text-xl text-[#000000]">
                @Lang("base.text35")
            </p>
            <div class="space-y-4">
                <div class="flex items-center space-x-3 ">
                    <div class="bg-green-600 text-green-600 py-[8px] px-[6px] rounded-full">
                        <img class="w-[13px] h-[11px]" src="{{ asset('uploads/img/gmail-Photoroom.svg') }}" alt="gmail logo">
                    </div>
                    <span class="noto-sans text-xl">@Lang("base.email")</span>
                </div>
                <div class="flex items-center space-x-3">
                    <div class="bg-green-600 text-green-600 p-2 rounded-full">
                        <img src="{{ asset('uploads/img/phone.svg') }}" alt="phone logo">
                    </div>
                    <div class="space-y-1">
                        <p class="noto-sans text-xl">@Lang("base.tel1")</p>
                        <p class="noto-sans text-xl">@Lang("base.tel2")</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Aloqa Formasi -->
        <div id="formContainer" class="hide-on-mobile">
            <div class="bg-white p-6 rounded-2xl shadow-md space-y-4" id="contactForm">
                <h3 class="noto-sans font-semibold font-semibold text-[24px]">@Lang("base.enrollment")</h3>
                <input type="text" id="nameInput" placeholder="@lang('base.ismingiz')"
                       class="w-full border rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-green-500 placeholder:inter placeholder:text-lg placeholder:font-medium placeholder:text-[#979797]"
                       required />
                <input type="text" id="phoneInput" placeholder="@Lang('base.tel_raqamingiz')"
                       class="w-full border rounded-lg p-2  focus:outline-none focus:ring-2 focus:ring-green-500 placeholder:inter placeholder:text-lg placeholder:font-medium placeholder:text-[#979797]"
                       required />
                {{--                <label for="branchSelect" class="pt-[8px]">Filialni tanglang</label>--}}
                <select id="branchSelect"
                        class="w-full border rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-green-500 option:inter option:text-lg option:font-medium"
                        required>
                    <option disabled> @Lang("base.text40")</option>
                    <option value="1" >@lang("base.branches.1.name")</option>
                    @foreach($branches as $branch)
                        <option value="{{$branch->id}}" >@lang("base.branches.$branch->id.name")</option>
                    @endforeach
                </select>
                <button id="submitButton"
                        class="inter font-bold text-xl w-full bg-green-600 text-white py-2 rounded-lg hover:bg-green-700 transition opacity-50 cursor-not-allowed"
                        disabled>
                    @Lang('base.send')
                </button>
            </div>

            <!-- Muvaffaqiyatli yozuv -->
            <div id="successMessage" class="hidden bg-white p-[32px] rounded-2xl shadow-md max-w-[469px] w-full">
                <svg xmlns="http://www.w3.org/2000/svg" class="text-green-500 mb-[20px]" width="100" height="100"
                     viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                     stroke-linejoin="round">
                    <!-- Galochka -->
                    <path d="M9 12l2 2 4-4" id="checkMark" style="stroke-dasharray: 15; stroke-dashoffset: 15;">
                    </path>
                    <!-- Aylana -->
                    <circle cx="12" cy="12" r="10" id="circle" style="stroke-dasharray: 63; stroke-dashoffset: 63;">
                    </circle>
                </svg>
                <div>
                    <h3 class="noto-sans text-[28px] leading-[38.14px] font-bold opacity-0 tracking-wide"
                        id="successTitle">
                        @Lang("base.text36")
                    </h3>
                    <p class="mt-2 mb-[24px] noto-sans  text-xl leading-[27.24px] opacity-0" id="successText">
                        @Lang("base.text37")
                    </p>
                </div>
            </div>


        </div>
    </div>
</div>

<!-- ------------------ Filiallarimiz start ------------------------ -->

<div id="filiallar" class="max-w-7xl mx-auto py-24 px-6 bg-[#f8f9fe]">
    <h2 class="uppercase noto-sans  text-sm font-bold text-[#E7373C] mb-5">
        @Lang("base.branches")
    </h2>
    <ul class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 mt-16">
        @foreach($branches as $branch)
            <li class="bg-white p-6 rounded-lg w-full flex flex-col justify-between">
                <img class="w-full h-48 object-cover rounded-md" src="{{ asset('uploads/images/branches/'.$branch->image)}}" alt="Filial Image" />
                <p class="noto-sans font-semibold mt-6 text-xl ">@Lang("base.branches.$branch->id.name")</p>
                <p class="noto-sans font-medium text-[#338038] text-lg mt-2">@Lang("base.branches.".$branch->id.".address")</p>
                <p class="noto-sans font-medium text-[18px] text-[#091E29] leading-[24.52px] mt-3 mb-6">
                    @Lang("base.branches.$branch->id.description")
                </p>
                <div class="flex justify-between items-center text-[#4A9F50]">
                    <div class="flex items-center gap-2 cursor-pointer">
                        <svg width="16" height="18" viewBox="0 0 15.334 17.4038" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M7.66 10.16C6.28 10.16 5.16 9.04 5.16 7.66C5.16 6.28 6.28 5.16 7.66 5.16C9.04 5.16 10.16 6.28 10.16 7.66C10.16 9.04 9.04 10.16 7.66 10.16ZM8.84 15.91C8.53 16.22 8.1 16.4 7.66 16.4C7.22 16.4 6.8 16.22 6.48 15.91L2.95 12.38C2.02 11.44 1.38 10.26 1.12 8.96C0.87 7.67 1 6.33 1.5 5.11C2.01 3.89 2.86 2.85 3.96 2.12C5.05 1.39 6.34 1 7.66 1C8.98 1 10.27 1.39 11.37 2.12C12.46 2.85 13.32 3.89 13.82 5.11C14.33 6.33 14.46 7.67 14.2 8.96C13.94 10.26 13.31 11.44 12.38 12.38L8.84 15.91Z"
                                stroke="#4A9F50" stroke-width="2" stroke-linejoin="round" />
                        </svg>

                        <p class="inter text-lg font-bold" onclick='setMap("{{$branch->location??"41.2965807, 69.275822"}}")'>@Lang("base.show_map")</p>
                    </div>
                    <a href='tel:@Lang("base.tel1")'>
                        <i class="fas fa-phone-alt text-[#4A9F50]"></i>
                    </a>
{{--                    <svg class="cursor-pointer" width="18" height="18" viewBox="0 0 17 17" fill="none"--}}
{{--                         xmlns="http://www.w3.org/2000/svg">--}}
{{--                        <path--}}
{{--                            d="M3.5 11C2.11 11 1 9.88 1 8.5C1 7.11 2.11 6 3.5 6C4.88 6 6 7.11 6 8.5C6 9.88 4.88 11 3.5 11ZM13.5 6C12.11 6 11 4.88 11 3.5C11 2.11 12.11 1 13.5 1C14.88 1 16 2.11 16 3.5C16 4.88 14.88 6 13.5 6ZM13.5 16C12.11 16 11 14.88 11 13.5C11 12.11 12.11 11 13.5 11C14.88 11 16 12.11 16 13.5C16 14.88 14.88 16 13.5 16ZM5.75 7.41L11.25 4.58M5.75 9.58L11.25 12.41"--}}
{{--                            stroke="#338038" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />--}}
{{--                    </svg>--}}
                </div>
            </li>
        @endforeach
    </ul>
</div>


<!-- ------------------ Filiallarimiz end ------------------------ -->

<!-- ------------------ Xizmatlarimiz start ------------------------ -->

<div id="xizmatlar" class="max-w-7xl mx-auto items-center pb-[100px] p-6 bg-[#f8f9fe]">
    <div class="text-center w-full lg:w-[520px] mb-8 mx-auto">
        <h2 class="noto-serif text-[40px]  font-medium">@Lang("base.services")</h2>
        <p class="noto-sans font-medium text-[20px] mt-[30px]">
            @Lang("base.text25")
        </p>
        <div class="p-5 flex justify-between rounded-lg bg-[#FFFFFF] mt-10 gap-4">
            <button id="btn10" class="inter active font-bold text-[20px] leading-[24.2px]  hover:bg-[#338038] hover:text-white py-4 rounded-lg w-full  transition">
                @Lang("base.text26")
            </button>
            <button id="btnAmbulator"
                class=" text-black text-[20px] inter font-bold leading-[24.2px] py-4 rounded-lg w-full hover:bg-[#338038] hover:text-white transition">
                @Lang("base.Ambulator")
            </button>
        </div>
    </div>

    <div id="tab10" class="bg-gray-50 p-8  rounded-lg max-w-7xl mx-auto flex items-center flex-col lg:flex-row gap-10">
        <!-- Chap qism -->
        <div class="flex-1 space-y-6">
            <img src="{{ asset('uploads/img/dastur icon.svg') }}" alt="Icon logo">

            <h2 class="noto-sans text-[32px] font-bold">@Lang("base.text26")</h2>

            <p class="noto-sans text-lg text-[#091E29] font-bold ">
                @Lang("base.text27")
            </p>
            <ul class="space-y-3 text-gray-700">
                <li class="flex items-start space-x-2">
                    <img src="{{ asset('uploads/img/galochka.svg') }}" alt="galochka icon">
                    <span class="noto-sans font-medium text-lg leading-[24.52px] text-[#091E29]">
                        @Lang("base.text28")</span>
                </li>
                <li class="flex items-start space-x-2 !mt-[21px]">
                    <img src="{{ asset('uploads/img/galochka.svg') }}" alt="galochka icon">
                    <span class="noto-sans font-medium text-lg leading-[24.52px] text-[#091E29]">
                        @Lang("base.text29")</span>
                </li>
                <li class="flex items-start space-x-2 !mt-[21px]">
                    <img src="{{ asset('uploads/img/galochka.svg') }}" alt="galochka icon">
                    <span class="noto-sans font-medium text-lg leading-[24.52px] text-[#091E29]">
                        @Lang("base.text30")</span>
                </li>
                <li class="flex items-start space-x-2 !mt-[21px]">
                    <img src="{{ asset('uploads/img/galochka.svg') }}" alt="galochka icon">
                    <span class="noto-sans font-medium text-lg leading-[24.52px] text-[#091E29]">
                        @Lang("base.text31")</span>
                </li>
                <li class="flex items-start space-x-2 !mt-[21px]">
                    <img src="{{ asset('uploads/img/galochka.svg') }}" alt="galochka icon">
                    <span class="noto-sans font-medium text-lg leading-[24.52px] text-[#091E29]">
                        @Lang("base.text32")</span>
                </li>
                <li class="flex items-start space-x-[10px] !mt-[21px]">
                    <img src="{{ asset('uploads/img/galochka.svg') }}" alt="galochka icon">
                    <span class="noto-sans font-medium text-lg leading-[24.52px] text-[#091E29]">
                        @Lang("base.text33")</span>
                </li>
            </ul>
            <div class="pt-[60px]">
                <a href="#aloqa" class=" inter font-bold text-xl leading-[24.2px] bg-green-600 text-white p-[20px] rounded-[10px] hover:bg-green-700 transition">
                    @Lang("base.enrollment")
                </a>
            </div>
        </div>

        <!-- O'ng qism -->
        <div class="flex-[1.5] flex flex-wrap gap-4">
            @foreach($branches as $branch)
                <div class="bg-white p-6 rounded-2xl shadow-md space-y-2 w-full lg:w-[48%]">
                    <h3 class="noto-sans font-semibold text-xl">@Lang("base.branches.$branch->id.name")</h3>
{{--                    <p class="noto-sans font-medium text-lg text-[#979797]">{{ $branch->address }}</p>--}}
                    <p class="noto-sans text-[#4A9F50] font-medium !mt-[16px]">{{  $branch->price }} @Lang("base.som")</p>
                </div>
            @endforeach
        </div>

    </div>
    <div id="tabAmbulator" class="hidden bg-gray-50 p-8  rounded-lg max-w-7xl mx-auto flex items-center flex-col lg:flex-row gap-10">
        <!-- Chap qism -->
        <div class="flex-1 space-y-6">
            <h2 class="noto-sans text-[32px] font-bold">@Lang("base.Ambulator")</h2>

            <p class="noto-sans text-lg text-[#091E29] font-bold">
                @Lang("base.text42")
            </p>
            <ul class="space-y-3 text-gray-700">
                <li class="flex items-start space-x-2">
                    <img src="{{ asset('uploads/img/galochka.svg') }}" alt="galochka icon">
                    <span class="noto-sans font-medium text-lg leading-[24.52px] text-[#091E29]">
                        @Lang("base.text43")</span>
                </li>
                <li class="flex items-start space-x-2 !mt-[21px]">
                    <img src="{{ asset('uploads/img/galochka.svg') }}" alt="galochka icon">
                    <span class="noto-sans font-medium text-lg leading-[24.52px] text-[#091E29]">
                        @Lang("base.text44")</span>
                </li>
                <li class="flex items-start space-x-2 !mt-[21px]">
                    <img src="{{ asset('uploads/img/galochka.svg') }}" alt="galochka icon">
                    <span class="noto-sans font-medium text-lg leading-[24.52px] text-[#091E29]">
                        @Lang("base.text45")</span>
                </li>
                <li class="flex items-start space-x-2 !mt-[21px]">
                    <img src="{{ asset('uploads/img/galochka.svg') }}" alt="galochka icon">
                    <span class="noto-sans font-medium text-lg leading-[24.52px] text-[#091E29]">
                        @Lang("base.text46")</span>
                </li>
                <li class="flex items-start space-x-2 !mt-[21px]">
                    <img src="{{ asset('uploads/img/galochka.svg') }}" alt="galochka icon">
                    <span class="noto-sans font-medium text-lg leading-[24.52px] text-[#091E29]">
                        @Lang("base.text47")</span>
                </li>
                <li class="flex items-start space-x-2 !mt-[21px]">
                    <img src="{{ asset('uploads/img/galochka.svg') }}" alt="galochka icon">
                    <span class="noto-sans font-medium text-lg leading-[24.52px] text-[#091E29]">
                        @Lang("base.text48")</span>
                </li>
                <li class="flex items-start space-x-2 !mt-[21px]">
                    <img src="{{ asset('uploads/img/galochka.svg') }}" alt="galochka icon">
                    <span class="noto-sans font-medium text-lg leading-[24.52px] text-[#091E29]">
                        @Lang("base.text49")</span>
                </li>
                <li class="flex items-start space-x-2 !mt-[21px]">
                    <img src="{{ asset('uploads/img/galochka.svg') }}" alt="galochka icon">
                    <span class="noto-sans font-medium text-lg leading-[24.52px] text-[#091E29]">
                        @Lang("base.text50")</span>
                </li>
            </ul>
            <div class="pt-[60px]">
                <a href="#aloqa" class=" inter font-bold text-xl leading-[24.2px] bg-green-600 text-white p-[20px] rounded-[10px] hover:bg-green-700 transition">
                    @Lang("base.enrollment")
                </a>
            </div>
        </div>
    </div>


</div>

<!-- ------------------ Xizmatlarimiz end ------------------------ -->

<!-- Modal oynacha -->
<div id="successModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white p-[32px] rounded-[20px] shadow-md text-center">
        <p class="text-lg noto-sans leading-[21.79px]">@Lang("base.text38")</p>
        <button id="okButton"
                class="mt-[32px] bg-green-600 hover:bg-green-700 text-white px-[70.5px] py-4 rounded-md inter font-bold text-xl">OK</button>
    </div>
</div>
<!-- Add this modal structure at the end of the body -->
<div id="mapModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-50">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-3xl">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold">Yandex Map</h2>
            <button id="closeModal" class="text-black">&times;</button>
        </div>
        <div id="yandexMap" class="w-full h-96"></div>
    </div>
</div>



<!-- ------------------ Footer ------------------ -->
<footer class="pt-24 pb-40 mt-24 bg-[#338038] w-full">
    <div class="max-w-6xl mx-auto flex flex-col md:flex-row md:justify-between gap-12 md:gap-0">
        <!-- Logo -->
        <div class="flex justify-left md:justify-start px-4">
            <img class="w-[150px] md:w-[171.59px] h-[70px] md:h-[74px]" src="{{ asset('uploads/img/logo-white.png') }}"
                 alt="Orzu Medical logo" />
        </div>

        <div class="flex justify-between px-4 lg:px-0 lg:justify-around w-full">
            <!-- Services Links -->
            <div class="text-left">
                <ul>
                    <li class="mb-5">
                        <a class="noto-sans font-medium text-lg leading-6 text-white hover:text-[#ABE09C] transition-colors duration-300"
                           href="#">@Lang("base.services2")</a>
                    </li>
                    <li class="mb-2.5">
                        <a class="noto-sans font-medium text-lg leading-6 text-white hover:text-[#ABE09C] transition-colors duration-300"
                           href="#">@Lang("base.Podologiya")</a>
                    </li>
                    <li class="mb-2.5">
                        <a class="noto-sans font-medium text-lg leading-6 text-white hover:text-[#ABE09C] transition-colors duration-300"
                           href="#">@Lang("base.Oftolmologiya")</a>
                    </li>
                    <li class="mb-2.5">
                        <a class="noto-sans font-medium text-lg leading-6 text-white hover:text-[#ABE09C] transition-colors duration-300"
                           href="#">@Lang("base.Protseduralar")</a>
                    </li>
                    <li class="mb-2.5">
                        <a class="nano-sans font-medium text-lg leading-6 text-white hover:text-[#ABE09C] transition-colors duration-300"
                           href="#">@Lang("base.Maslaxatlar")</a>
                    </li>
                    <li class="mb-2.5">
                        <a class="nano-sans font-medium text-lg leading-6 text-white hover:text-[#ABE09C] transition-colors duration-300"
                           href="#">@Lang("base.serv2")</a>
                    </li>
                    <li>
                        <a class="nano-sans font-medium text-lg leading-6 text-white hover:text-[#ABE09C] transition-colors duration-300"
                           href="#">@Lang("base.serv3")</a>
                    </li>
                </ul>
            </div>

            <!-- Branch Links -->
            <div class="text-left">
                <ul>
                    <li class="mb-5">
                        <a class="noto-sans font-medium text-lg leading-6 text-white hover:text-[#ABE09C] transition-colors duration-300"
                           href="#">@Lang("base.branch")</a>
                    </li>
                    @foreach($branches as $branch)
                        <li class="mb-2.5">
                            <a class="noto-sans font-medium text-lg leading-6 text-white hover:text-[#ABE09C] transition-colors duration-300">
                                @lang("base.branches.$branch->id.name")
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <a href="#aloqa"
           class="w-[236px] lg:w-full lg:hidden flex justify-center ml-4 lg:ml-0 items-center px-5 py-4 border rounded-xl hover:bg-[#41A34C] hover:scale-105 transition-all duration-300">
            <img src="{{ asset('uploads/img/tg icon.svg') }}" alt="icon tg" class="w-6 h-6" />
            <span class="inter font-bold ml-4 text-white text-lg">@Lang("base.enrollment")</span>
        </a>

        <div class="flex lg:block">
            <a href="#aloqa"
               class="w-[236px] lg:w-full hidden lg:flex justify-center ml-4 lg:ml-0 items-center px-5 py-4 border rounded-xl hover:bg-[#41A34C] hover:scale-105 transition-all duration-300">
                <img src="{{ asset('uploads/img/tg icon.svg') }}" alt="icon tg" class="w-6 h-6" />
                <span class="inter font-bold ml-4 text-white text-lg">@Lang("base.enrollment")</span>
            </a>

            <!-- Contact and Social -->
            <div class="w-full md:w-[254px] px-4 lg:px-0 flex flex-col items-center md:items-end">
                <p class="my-5 w-full text-wrap text-left md:text-right noto-sans text-lg text-white">
                    @Lang("base.text39")
                </p>
                <div class="w-full md:w-[179px] flex justify-start lg:justify-center md:justify-between gap-4">
                    <a class="hover:scale-110 transition-transform duration-300" href="https://www.instagram.com/orzumedical_uz/profilecard/?igsh=MWJ2bHEwZXF1YWhoNg%3D%3D">
                        <img src="{{ asset('uploads/img/insta icon.svg') }}" alt="insta icon" class="w-6 h-6" />
                    </a>
                    <a class="hover:scale-110 transition-transform duration-300" href="https://www.facebook.com/share/1Cwihs4Ndz/">
                        <img src="{{ asset('uploads/img/brand-facebook.svg') }}" alt="facebook icon" class="w-6 h-6" />
                    </a>
                    <a class="hover:scale-110 transition-transform duration-300" href="https://youtube.com/@orzumedicaluz?feature=shared">
                        <img src="{{ asset('uploads/img/brand-youtube.svg') }}" alt="youtube icon" class="w-6 h-6" />
                    </a>
                    <a class="hover:scale-110 transition-transform duration-300" href="https://t.me/orzu_medical">
                        <img src="{{ asset('uploads/img/brand-telegram.svg') }}" alt="telegram icon" class="w-6 h-6" />
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>

<script src="https://api-maps.yandex.ru/2.1/?apikey=822883d3-3053-47eb-a211-8118591f9d17&lang=ru_RU"
        type="text/javascript"></script>
{{--<script src="https://api-maps.yandex.ru/2.1/?lang=en_RU" type="text/javascript"></script>--}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const mapModal = document.getElementById('mapModal');
        const closeModal = document.getElementById('closeModal');
        let location = "41.2965807, 69.275822";
        let map;
        let placemark;
        window.setMap = function setMap(newLocation) {
            mapModal.classList.remove('hidden');
            location = newLocation;
            ymaps.ready(init);
        }
        mapModal.addEventListener('click', function (event) {
            if (event.target === mapModal) {
                mapModal.classList.add('hidden');
            }
        });
        closeModal.addEventListener('click', function () {
            mapModal.classList.add('hidden');
        });

        function init() {
            const coords = location.split(',').map(Number);
            if (!map) {
                map = new ymaps.Map('yandexMap', {
                    center: coords,
                    zoom: 10
                });
                placemark = new ymaps.Placemark(coords);
                map.geoObjects.add(placemark);
            } else {
                map.setCenter(coords);
                if (placemark) {
                    placemark.geometry.setCoordinates(coords);
                } else {
                    placemark = new ymaps.Placemark(coords);
                    map.geoObjects.add(placemark);
                }
            }
        }
    });
</script>
<!-- JavaScript ulanishi -->
<script src="https://cdn.tailwindcss.com"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.5/gsap.min.js"></script>
<script src="{{ asset('argon') }}/vendor/jquery/dist/jquery.min.js"></script>
<script src="{{ asset('assets/js/script.js') }}" defer></script>
<script src="{{asset('assets/vendor/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>

@if(session('_message'))
    <script>
        Swal.fire({
            position: 'top-end',
            type: "{{ session('_type') }}",
            title: "{{ session('_message') }}",
            showConfirmButton: false,
            timer: {{session('_timer') ?? 5000}}
        });
    </script>
    @php(message_clear())
@endif

</body>

</html>
