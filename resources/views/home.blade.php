@extends('template')
@section('title', 'home')
@section('content')
    <div style="margin-top: 75px;">
        {{-- for success message --}}
        @if (session('success'))
            <div class="alert alert-warning text-center d-flex justify-content-center align-items-center" role="alert">
                <i class="fa-solid fa-circle-check me-2 fs-2"></i>{{ session('success') }}
            </div>
        @endif
    </div>
    <!-- ======= Hero Section ======= -->
    <section id="home" class="row">
        <img src="{{ asset('images/home.jpg') }}" alt="doctor">
    </section>
    <!-- End Hero Section -->
    <!-- ======= About Section ======= -->
    <section id="about" class="about">
        <div class="container" data-aos="fade-up">
            <div class="section-header">
                <p>Learn More <span>About Us</span></p>
            </div>

            <div class="row gy-4">
                <div class="col-lg-7 position-relative about-img"
                    style="background-image: url('{{ asset('images/about1.jpg') }}') ;" data-aos="fade-up"
                    data-aos-delay="150">
                </div>
                <div class="col-lg-5 d-flex align-items-end" data-aos="fade-up" data-aos-delay="300">
                    <div class="content ps-0 ps-lg-5">
                        <p class="fst-italic">
                            <strong>About Us</strong><br>
                            It is an arrangement to meet the doctor and patient at a particular time in the clinic. For
                            successful life human being needs good health but illness is a part of life. The crowd in the
                            hospitals, long waiting of doctor appointments makes the patients more disturb.
                        </p>
                        <div class="position-relative mt-4">
                            <img src="{{ asset('images/about2.png') }}" class="img-fluid" alt="">
                            <a href="https://youtu.be/kK99NlPe0-0?si=_PZs5ptMHAwpwP3-" class="glightbox play-btn"></a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section><!-- End About Section -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
        <div class="container" data-aos="fade-up">

            <div class="section-header">
                <h2>Contact</h2>
                <p>Need Help? <span>Contact Us</span></p>
            </div>
            <!--Start Contact Form -->
            <div class="form-control mt-4">
                <form action="{{ route('contact') }}" method="post" role="form" class=" p-3 p-md-4">
                    @csrf
                    <div class="row mt-4">
                        <div class="col-xl-6">
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                id="name" placeholder="your name">
                        </div>
                        <div class="col-xl-6">
                            <input type="email" class="form-control" name="email" id="email"
                                placeholder="your email">
                        </div>
                    </div>
                    <div class="mt-4">
                        <input type="text" class="form-control" name="phone" id="subject"
                            placeholder="your phone number">
                    </div>
                    <div class="mt-4">
                        <textarea class="form-control @error('message') is-invalid @enderror" name="message" rows="5"
                            placeholder="your message"></textarea>
                    </div>
                    <div class="text-center mt-4"><button class="btn btn-danger text white" type="submit">Send
                            Message</button></div>
                </form>
            </div>
            <!--End Contact Form -->
        </div>
    </section>
    <!-- End Contact Section -->
@endsection
