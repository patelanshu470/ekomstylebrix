@extends('frontend.layouts.home_master')
@section('frontendContent')

   <!-- Breadcrumb Section Start -->
   <section class="faq-breadscrumb pt-0">
    <div class="container-fluid-lg">
        <div class="row">
            <div class="col-12">
                <div class="breadscrumb-contain">
                    <h2>FAQs</h2>
                    <p>"Got Questions? We've Got Answers! Explore our frequently asked questions to find solutions, tips, and insights on everything related to your shopping experience. If you can't find what you're looking for, our dedicated support team is here to assist you. Shopping made simple, just for you!".</p>
                
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Faq Question section Start -->

<!-- Faq Question section End -->

<!-- Faq Section Start -->
<section class="faq-box-contain section-b-space">
    <div class="container">
        <div class="row">
            <div class="col-xl-5">
                <div class="faq-contain">
                    <h2>Frequently Asked Questions</h2>
                    <p>We are answering most frequent questions. No worries if you not find exact one. You can find
                        out more by searching or continuing clicking button below or directly <a
                            href="{{route('contact.us')}}" class="theme-color text-decoration-underline">contact our
                            support.</a></p>
                </div>
            </div>
            <div class="col-xl-7">
                <div class="faq-accordion">
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    How can I place an order? <i
                                        class="fa-solid fa-angle-down"></i>
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show"
                                aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>To place an order, simply browse our product catalog, select the items you want, and add them to your cart. Proceed to checkout, where you can review your order and enter your shipping and payment information.</p>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    What payment methods do you accept <i
                                        class="fa-solid fa-angle-down"></i>
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>We accept a variety of payment methods, including credit/debit cards (Visa, Mastercard, American Express). You can choose your preferred payment method during checkout.</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseThree" aria-expanded="false"
                                    aria-controls="collapseThree">
                                    How do I track my order?<i class="fa-solid fa-angle-down"></i>
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse"
                                aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>After your order is confirmed, you will check your order details and tracking id in your profile section </p>
                                </div>
                            </div>
                        </div>
                      
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingFive">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseFive" aria-expanded="false"
                                    aria-controls="collapseFive">
                                    How long does shipping take?<i class="fa-solid fa-angle-down"></i>
                                </button>
                            </h2>
                            <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>Shipping times may vary depending on your location and the shipping method chosen during checkout. Typically, orders are delivered within 7 business days. You can find more details on our Shipping Information page.</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingSix">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                    Are my personal and payment details secure? <i
                                        class="fa-solid fa-angle-down"></i>
                                </button>
                            </h2>
                            <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>We take your security seriously. Our website uses SSL encryption to protect your personal and payment information. Your data is safe and confidential.</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingSeven">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseSeven" aria-expanded="true"
                                    aria-controls="collapseSeven">
                                    How can I contact customer support? <i
                                        class="fa-solid fa-angle-down"></i>
                                </button>
                            </h2>
                            <div id="collapseSeven" class="accordion-collapse collapse"
                                aria-labelledby="headingSeven" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>If you have any questions, concerns, or issues, our customer support team is here to help. You can reach us through our Contact Us page or by contact@stylebrix.com. We're dedicated to providing excellent customer service.</p>
                          
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingEight">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseEight" aria-expanded="false"
                                    aria-controls="collapseEight">
                                    What if I receive a damaged or incorrect item? <i
                                        class="fa-solid fa-angle-down"></i>
                                </button>
                            </h2>
                            <div id="collapseEight" class="accordion-collapse collapse"
                                aria-labelledby="headingEight" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>If you receive a damaged or incorrect item, please contact our customer support team immediately. We will arrange for a replacement or refund, depending on the situation.</p>
                                </div>
                            </div>
                        </div>

                    
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Faq Section End -->

@endsection