@extends('layouts.app')

@section('content')
<style>
/* Neutral black/white/gray style for nav-tabs */
.nav-tabs .nav-link {
    color: #444;
    background-color: #f8f9fa;
    border: 1px solid #dee2e6;
    margin-right: 5px;
    transition: all 0.2s ease-in-out;
}
.nav-tabs .nav-link:hover {
    background-color: #e9ecef;
    color: #000;
}
.nav-tabs .nav-link.active {
    color: #fff;
    background-color: #9ea1a3ff;
    border-color: #343a40 #343a40 #fff;
}
/* Table wrapper to control width */
.size-table-wrapper {
    max-width: 700px;
    margin: 0 auto;
}
</style>

<div class="container py-5">
    <h1 class="fw-bold mb-4 text-center">Size Guide</h1>

    <div class="alert alert-light border shadow-sm text-center mb-5">
        <p class="mb-3">
            🧵 Find the right fit for Men, Women, and Kids. Measurements are shown in inches. Please refer to the size charts below to ensure the best fit before placing your order. 
        </p>
        <a href="/contact" class="btn btn-outline-dark btn-sm">
            Need Help? Contact Us
        </a>
    </div>

    <!-- Tabs -->
    <ul class="nav nav-tabs justify-content-center mb-4" id="sizeGuideTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="men-tab" data-bs-toggle="tab" data-bs-target="#men" type="button" role="tab">Men</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="women-tab" data-bs-toggle="tab" data-bs-target="#women" type="button" role="tab">Women</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="kids-tab" data-bs-toggle="tab" data-bs-target="#kids" type="button" role="tab">Kids</button>
        </li>
    </ul>

    <!-- Tab Content -->
    <div class="tab-content" id="sizeGuideContent">

        <!-- Men -->
        <div class="tab-pane fade show active" id="men" role="tabpanel">
            <div class="card shadow-sm border-0 mb-4 size-table-wrapper">
                <div class="card-body">
                    <h4 class="fw-bold mb-3">Men's</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm table-striped table-hover text-center align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Size</th>
                                    <th>Chest</th>
                                    <th>Waist</th>
                                    <th>Hip</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr><td>XS</td><td>34</td><td>28</td><td>35</td></tr>
                                <tr><td>S</td><td>36</td><td>30</td><td>37</td></tr>
                                <tr><td>M</td><td>38</td><td>32</td><td>39</td></tr>
                                <tr><td>L</td><td>40</td><td>34</td><td>41</td></tr>
                                <tr><td>XL</td><td>42</td><td>36</td><td>43</td></tr>
                                <tr><td>XXL</td><td>44</td><td>38</td><td>45</td></tr>
                                <tr><td>XXXL</td><td>46</td><td>40</td><td>47</td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Women -->
        <div class="tab-pane fade" id="women" role="tabpanel">
            <div class="card shadow-sm border-0 mb-4 size-table-wrapper">
                <div class="card-body">
                    <h4 class="fw-bold mb-3">Women's</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm table-striped table-hover text-center align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Size</th>
                                    <th>Bust</th>
                                    <th>Waist</th>
                                    <th>Hip</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr><td>XS</td><td>32</td><td>24</td><td>34</td></tr>
                                <tr><td>S</td><td>34</td><td>26</td><td>36</td></tr>
                                <tr><td>M</td><td>36</td><td>28</td><td>38</td></tr>
                                <tr><td>L</td><td>38</td><td>30</td><td>40</td></tr>
                                <tr><td>XL</td><td>40</td><td>32</td><td>42</td></tr>
                                <tr><td>XXL</td><td>42</td><td>34</td><td>44</td></tr>
                                <tr><td>XXXL</td><td>44</td><td>36</td><td>46</td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kids -->
        <div class="tab-pane fade" id="kids" role="tabpanel">
            <div class="card shadow-sm border-0 mb-4 size-table-wrapper">
                <div class="card-body">
                    <h4 class="fw-bold mb-3">Kids</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm table-striped table-hover text-center align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Size</th>
                                    <th>Height (in)</th>
                                    <th>Chest</th>
                                    <th>Waist</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr><td>XS</td><td>40–44</td><td>22</td><td>20</td></tr>
                                <tr><td>S</td><td>45–50</td><td>24</td><td>21</td></tr>
                                <tr><td>M</td><td>51–56</td><td>26</td><td>23</td></tr>
                                <tr><td>L</td><td>57–62</td><td>28</td><td>24</td></tr>
                                <tr><td>XL</td><td>63–68</td><td>30</td><td>26</td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
