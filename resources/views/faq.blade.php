@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="mb-4">Frequently Asked Questions</h1>

    <div class="accordion" id="faqAccordion">

        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" 
                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    What is your return policy?
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" 
                 aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    We accept returns within 30 days of purchase. The product must be unused and in original packaging.
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                        data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    How long does shipping take?
                </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" 
                 aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Standard shipping takes 3–5 business days. Express shipping is available at checkout.
                </div>
            </div>
        </div>

        <!-- Additional FAQ items -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                        data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    Do you ship internationally?
                </button>
            </h2>
            <div id="collapseThree" class="accordion-collapse collapse" 
                 aria-labelledby="headingThree" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Yes, we ship to most countries worldwide. Shipping costs and times vary by location.
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header" id="headingFour">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                        data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                    Can I track my order?
                </button>
            </h2>
            <div id="collapseFour" class="accordion-collapse collapse" 
                 aria-labelledby="headingFour" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Yes, once your order ships, you will receive a tracking number via email.
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header" id="headingFive">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                        data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                    What payment methods do you accept?
                </button>
            </h2>
            <div id="collapseFive" class="accordion-collapse collapse" 
                 aria-labelledby="headingFive" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    We accept Visa, MasterCard, PayPal, and Apple Pay.
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header" id="headingSix">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                        data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                    How do I cancel or change my order?
                </button>
            </h2>
            <div id="collapseSix" class="accordion-collapse collapse" 
                 aria-labelledby="headingSix" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Please contact customer support as soon as possible to cancel or modify your order.
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header" id="headingSeven">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                        data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                    Do you offer gift wrapping?
                </button>
            </h2>
            <div id="collapseSeven" class="accordion-collapse collapse" 
                 aria-labelledby="headingSeven" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Yes, gift wrapping is available for an additional fee at checkout.
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header" id="headingEight">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                        data-bs-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                    What should I do if my order is damaged?
                </button>
            </h2>
            <div id="collapseEight" class="accordion-collapse collapse" 
                 aria-labelledby="headingEight" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Please contact us immediately with photos of the damaged product so we can assist you.
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header" id="headingNine">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                        data-bs-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine">
                    Can I return a sale item?
                </button>
            </h2>
            <div id="collapseNine" class="accordion-collapse collapse" 
                 aria-labelledby="headingNine" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Sale items are final sale and cannot be returned or exchanged.
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header" id="headingTen">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                        data-bs-target="#collapseTen" aria-expanded="false" aria-controls="collapseTen">
                    How do I reset my password?
                </button>
            </h2>
            <div id="collapseTen" class="accordion-collapse collapse" 
                 aria-labelledby="headingTen" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Click on "Forgot Password" at login and follow the instructions to reset your password.
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header" id="headingEleven">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                        data-bs-target="#collapseEleven" aria-expanded="false" aria-controls="collapseEleven">
                    Do you have a loyalty program?
                </button>
            </h2>
            <div id="collapseEleven" class="accordion-collapse collapse" 
                 aria-labelledby="headingEleven" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Yes, sign up for our newsletter to receive updates on loyalty rewards and exclusive offers.
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header" id="headingTwelve">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                        data-bs-target="#collapseTwelve" aria-expanded="false" aria-controls="collapseTwelve">
                    How do I contact customer support?
                </button>
            </h2>
            <div id="collapseTwelve" class="accordion-collapse collapse" 
                 aria-labelledby="headingTwelve" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    You can reach our customer support via email at hello@auraluxe.com or call  +94 711355535.
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
