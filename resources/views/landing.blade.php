<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Photography Landing Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
</head>

<body class="bg-black text-white font-sans">

    <!-- Navbar -->
    <header class="fixed top-0 w-full bg-black/80 z-50 shadow">
        <div class="container mx-auto flex justify-between items-center py-4 px-6">
            <h1 class="text-2xl font-bold">Mudi</h1>
            <nav>
                <ul class="flex space-x-6 text-sm">
                    <li><a href="#" class="hover:text-gray-300">Home</a></li>
                    <li><a href="#" class="hover:text-gray-300">Project</a></li>
                    <li><a href="#" class="hover:text-gray-300">Blog</a></li>
                    <li><a href="#" class="hover:text-gray-300">Portfolio</a></li>
                    <li><a href="{{ route('login') }}" class="hover:text-gray-300">Login</a></li>
                     @if (Route::has('register'))
                            <a
                                href="{{ route('register') }}"
                                class="hover:text-gray-300">
                                Register
                            </a>
                        @endif
                </ul>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="relative h-screen flex items-center justify-center bg-cover bg-center"
        style="background-image: url('https://images.unsplash.com/photo-1631434830442-52c0fee31406?fm=jpg&q=60&w=3000&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');">
        <div class="absolute inset-0 bg-black/60"></div>
        <h2 class="relative px-3 text-6xl md:text-8xl font-extrabold">Mudi Photostudio</h2>
    </section>

    <!-- Our Work -->
    <section class="py-16 container mx-auto px-6">
        <h3 class="text-3xl font-semibold mb-6">Our Work</h3>
        <p class="max-w-2xl mb-8 text-gray-300">Discover our portfolio & our photography philosophy. Every image
            embodies our commitment to precision and storytelling, from breathtaking landscapes to intimate portraits.
        </p>
        <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
            <img src="{{ asset('capture/capture-6.jpg') }}" class="rounded-lg shadow-lg" alt="">
            <img src="{{ asset('capture/capture-1.jpg') }}" class="rounded-lg shadow-lg" alt="">
            <img src="{{ asset('capture/capture-2.jpg') }}" class="rounded-lg shadow-lg" alt="">
            <img src="{{ asset('capture/capture-3.jpg') }}" class="rounded-lg shadow-lg" alt="">
            <img src="{{ asset('capture/capture-7.jpg') }}" class="rounded-lg shadow-lg" alt="">

        </div>
    </section>

    <!-- Testimonial -->
    {{-- <section class="py-16 bg-black/90">
        <div class="container mx-auto text-center px-6">
            <h3 class="text-3xl font-semibold mb-8">What Our Clients Say</h3>
            <div class="flex justify-center mb-6">
                <img src="https://images.unsplash.com/photo-1504196606672-aef5c9cefc92"
                    class="rounded-lg w-96 shadow-lg" alt="">
            </div>
            <p class="max-w-xl mx-auto text-gray-300">"As a client, I couldn’t be more pleased with the photography
                services provided. The smooth workflow, keen attention to detail, and ability to capture genuine moments
                surpassed my expectations."</p>
        </div>
    </section> --}}

    <!-- Testimonial Section -->
    <section class="py-16 bg-black/90">
        <div class="container mx-auto text-center px-6">
            <h3 class="text-3xl font-semibold mb-8">What Our Clients Say</h3>

            <!-- Swiper -->
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">

                    <!-- Testimonial 1 -->
                    <div class="swiper-slide">
                        <div class="flex flex-row gap-x-3">
                            <div class="flex flex-col items-center">
                                <img src="https://plus.unsplash.com/premium_photo-1722859288966-b00ef70df64b?q=80&w=1103&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                    class="rounded-lg w-80 h-56 object-cover shadow-lg mb-6" alt="">
                                <p class="max-w-xl text-gray-300">"As a client, I couldn’t be more pleased with the
                                    photography services provided. The smooth workflow, keen attention to detail, and
                                    ability to capture genuine moments surpassed my expectations."</p>
                            </div>
                            <div class="flex flex-col items-center">
                                <img src="https://images.unsplash.com/photo-1542909168-82c3e7fdca5c?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MzZ8fHBvdHJhaXR8ZW58MHx8MHx8fDA%3D"
                                    class="rounded-lg w-80 h-56 object-cover shadow-lg mb-6" alt="">
                                <p class="max-w-xl text-gray-300">"As a client, I couldn’t be more pleased with the
                                    photography services provided. The smooth workflow, keen attention to detail, and
                                    ability to capture genuine moments surpassed my expectations."</p>
                            </div>
                        </div>
                    </div>

                    <!-- Testimonial 2 -->
                    <div class="swiper-slide">
                        <div class="flex flex-row gap-x-3">
                            <div class="flex flex-col items-center">
                                <img src="https://plus.unsplash.com/premium_photo-1682096252599-e8536cd97d2b?q=80&w=870&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                    class="rounded-lg w-80 h-56 object-cover shadow-lg mb-6" alt="">
                                <p class="max-w-xl text-gray-300">"As a client, I couldn’t be more pleased with the
                                    photography services provided. The smooth workflow, keen attention to detail, and
                                    ability to capture genuine moments surpassed my expectations."</p>
                            </div>
                            <div class="flex flex-col items-center">
                                <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?q=80&w=387&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                    class="rounded-lg w-80 h-56 object-cover shadow-lg mb-6" alt="">
                                <p class="max-w-xl text-gray-300">"As a client, I couldn’t be more pleased with the
                                    photography services provided. The smooth workflow, keen attention to detail, and
                                    ability to capture genuine moments surpassed my expectations."</p>
                            </div>
                        </div>
                    </div>

                    <!-- Testimonial 3 -->
                    <div class="swiper-slide">
                        <div class="flex flex-row gap-x-3">
                            <div class="flex flex-col items-center">
                                <img src="https://images.unsplash.com/photo-1611734448607-269c857c36af?q=80&w=870&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                    class="rounded-lg w-80 h-56 object-cover shadow-lg mb-6" alt="">
                                <p class="max-w-xl text-gray-300">"As a client, I couldn’t be more pleased with the
                                    photography services provided. The smooth workflow, keen attention to detail, and
                                    ability to capture genuine moments surpassed my expectations."</p>
                            </div>
                            <div class="flex flex-col items-center">
                                <img src="https://images.unsplash.com/photo-1661669735258-156f91341de7?q=80&w=870&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                    class="rounded-lg w-80 h-56 object-cover shadow-lg mb-6" alt="">
                                <p class="max-w-xl text-gray-300">"As a client, I couldn’t be more pleased with the
                                    photography services provided. The smooth workflow, keen attention to detail, and
                                    ability to capture genuine moments surpassed my expectations."</p>
                            </div>
                        </div>
                    </div>

                    <!-- Testimonial 4 -->
                    <div class="swiper-slide">
                        <div class="flex flex-col items-center">
                            <img src="https://images.unsplash.com/photo-1520813792240-56fc4a3765a7"
                                class="rounded-lg w-80 h-56 object-cover shadow-lg mb-6" alt="">
                            <p class="max-w-xl text-gray-300">"Professional, friendly, and extremely talented! I highly
                                recommend them for anyone looking for top-notch photography."</p>
                        </div>
                    </div>

                    <!-- Testimonial 5 -->
                    <div class="swiper-slide">
                        <div class="flex flex-col items-center">
                            <img src="https://images.unsplash.com/photo-1535713875002-d1d0cf377fde"
                                class="rounded-lg w-80 h-56 object-cover shadow-lg mb-6" alt="">
                            <p class="max-w-xl text-gray-300">"We had a family shoot, and the results were incredible.
                                Every smile and laugh was captured perfectly. Thank you!"</p>
                        </div>
                    </div>

                </div>

                <!-- Swiper Navigation -->
                <div class="flex justify-center mt-6 space-x-4">
                    <div class="swiper-button-prev !text-white"></div>
                    <div class="swiper-button-next !text-white"></div>
                </div>

                <!-- Swiper Pagination -->
                <div class="swiper-pagination mt-4"></div>
            </div>
        </div>
    </section>

    {{-- Price List Section --}}
    <section class="py-20">
    <div class="container mx-auto px-6">
      <h2 class="text-4xl font-bold text-center mb-12">Our Photo Studio Packages</h2>

      <div class="grid md:grid-cols-3 gap-8">

        <!-- Basic Package -->
        <div class="bg-white rounded-2xl shadow-lg p-8 border hover:scale-105 transition">
          <p class="text-sm font-semibold text-black mb-2">Basic</p>
          <h3 class="text-4xl font-extrabold text-black mb-2">Rp. 600.000,-</h3>
          <p class="text-gray-500 mb-6">per session</p>
          <a href="#" class="block bg-gray-800  text-white py-2 rounded-lg text-center font-semibold hover:bg-yellow-400 hover:text-black transition mb-6">Choose Plan</a>
          <ul class="text-gray-600 space-y-3">
            <li>📸 1-hour photo session</li>
            <li>🖼 10 edited photos</li>
            <li>💾 Digital delivery</li>
            <li>🏢 In-studio only</li>
          </ul>
        </div>

        <!-- Premium Package (Most Popular) -->
        <div class="bg-gray-600 text-white rounded-2xl shadow-xl p-8 relative hover:scale-105 transition">
          <span class="absolute -top-4 left-1/2 -translate-x-1/2 bg-yellow-400 text-black px-4 py-1 rounded-full text-sm font-bold">Most Popular</span>
          <p class="text-sm font-semibold mb-2">Premium</p>
          <h3 class="text-4xl font-extrabold mb-2">Rp. 800.000,-</h3>
          <p class="text-gray-200 mb-6">per session</p>
          <a href="#" class="block bg-white text-gray-700 py-2 rounded-lg text-center font-semibold hover:bg-gray-100 transition mb-6">Choose Plan</a>
          <ul class="space-y-3">
            <li>📸 2-hour photo session</li>
            <li>🖼 25 edited photos</li>
            <li>💾 Digital + USB delivery</li>
            <li>🌆 Indoor & Outdoor</li>
            <li>👗 2 outfit changes</li>
          </ul>
        </div>

        <!-- Exclusive Package -->
        <div class="bg-white rounded-2xl shadow-lg p-8 border hover:scale-105 transition">
          <p class="text-sm font-semibold text-black mb-2">Exclusive</p>
          <h3 class="text-4xl text-black font-extrabold mb-2">Rp. 1.200.000,-</h3>
          <p class="text-gray-500 mb-6">per session</p>
          <a href="#" class="block bg-gray-800 text-white py-2 rounded-lg text-center font-semibold hover:bg-yellow-400 hover:text-black transition mb-6">Choose Plan</a>
          <ul class="text-gray-600 space-y-3">
            <li>📸 4-hour photo session</li>
            <li>🖼 50+ edited photos</li>
            <li>💾 Digital + Album + USB</li>
            <li>🌆 Indoor & Outdoor</li>
            <li>👗 Unlimited outfit changes</li>
            <li>🚘 Free transport to location</li>
          </ul>
        </div>

      </div>
    </div>
  </section>
  {{-- end Price List Section --}}

    <!-- Instagram Section -->
    <section class="py-16 container mx-auto px-6">
        <h3 class="text-3xl font-semibold text-center mb-10">Instagram</h3>
        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
            <img src="https://plus.unsplash.com/premium_photo-1669366530741-c8659ed0f406?q=80&w=387&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                class="rounded-lg shadow-lg" alt="">
            <img src="https://images.unsplash.com/photo-1604320817924-06609ea5742c?q=80&w=906&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                class="rounded-lg shadow-lg" alt="">
            <img src="https://images.unsplash.com/photo-1630225761431-56260e54e02e?q=80&w=943&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                class="rounded-lg shadow-lg" alt="">
            <img src="https://images.unsplash.com/photo-1506794778202-cad84cf45f1d" class="rounded-lg shadow-lg"
                alt="">
            <img src="https://images.unsplash.com/photo-1599537504477-ec5a7bb32321?q=80&w=774&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                class="rounded-lg shadow-lg" alt="">
            <img src="https://images.unsplash.com/photo-1535713875002-d1d0cf377fde" class="rounded-lg shadow-lg"
                alt="">
        </div>
    </section>

    <!-- CTA Section -->
    <section class="relative py-20 bg-cover bg-center"
        style="background-image: url('https://images.unsplash.com/photo-1600180758895-22f98f0a3f5d');">
        <div class="absolute inset-0 bg-black/70"></div>
        <div class="relative container mx-auto text-center text-white px-6">
            <h3 class="text-4xl font-bold mb-4">Capturing The Best Moments For You</h3>
            <p class="max-w-xl mx-auto mb-6 text-gray-300">Let us capture your story with cinematic highlights.
                Designed
                to immortalize your most precious memories in timeless elegance.</p>
            <a href="#"
                class="inline-block bg-white text-black px-6 py-3 rounded-lg font-semibold hover:bg-gray-300 transition">Book
                Appointment</a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-black py-12">
        <div class="container mx-auto grid md:grid-cols-4 gap-8 px-6 text-sm text-gray-400">

            <!-- Newsletter -->
            <div>
                <h4 class="text-lg font-semibold text-white mb-3">We make non-archive emails!</h4>
                <form class="flex space-x-2">
                    <input type="email" placeholder="Enter your email"
                        class="px-3 py-2 rounded-lg w-full text-black">
                    <button class="bg-white text-black px-4 py-2 rounded-lg">Submit</button>
                </form>
            </div>

            <!-- Quick Links -->
            <div>
                <h4 class="text-lg font-semibold text-white mb-3">Quick Links</h4>
                <ul class="space-y-2">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">About</a></li>
                    <li><a href="#">Services</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>

            <!-- Other Links -->
            <div>
                <h4 class="text-lg font-semibold text-white mb-3">Other Links</h4>
                <ul class="space-y-2">
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Terms & Conditions</a></li>
                    <li><a href="#">FAQs</a></li>
                </ul>
            </div>

            <!-- Contact -->
            <div>
                <h4 class="text-lg font-semibold text-white mb-3">Contact Info</h4>
                <p>Jl. Banda Aceh-Medan Tutu Leupe Cureh, Bireun, Aceh, Indonesia<br> Post Code 24261</p>
                <p>+62 811-7857-227</p>
                <p>info@email.com</p>
            </div>
        </div>

        <div class="text-center text-gray-500 mt-10 text-xs">
            © 2025 PhotoLens. All Rights Reserved.
        </div>
    </footer>

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper(".mySwiper", {
            slidesPerView: 1,
            spaceBetween: 30,
            loop: true,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });
    </script>
</body>

</html>
