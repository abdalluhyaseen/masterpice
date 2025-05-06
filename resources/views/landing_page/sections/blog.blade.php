<div class="container-fluid blog pb-5">
    <div class="container pb-5">
        <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
            <h4 class="text-primary">OurCourts</h4>
            <h1 class="display-5 mb-4">Explore Now The Various Courts The Best Courts In Jordan  </h1>
        </div>
        <div class="owl-carousel blog-carousel wow fadeInUp">
            @foreach($fields as $field)
                <div class="blog-item p-4">
                    <div class="blog-img mb-4">
                        @if($field->fieldImages->isNotEmpty())
                            <img src="{{ asset($field->fieldImages->first()->field_images) }}" class="img-fluid w-100 rounded" style="height: 200px; object-fit: cover;" alt="{{ $field->field_title }}">
                        @else
                            <img src="{{ asset('landing/img/placeholder.jpg') }}" class="img-fluid w-100 rounded" style="height: 200px; object-fit: cover;" alt="Placeholder">
                        @endif
                        <div class="blog-title">
                            <a href="{{ route('services.show', $field->id) }}" class="btn">{{ $field->field_name }}</a>
                        </div>
                    </div>
                    <a href="{{ route('fields.show', $field->id) }}" class="h4 d-inline-block mb-3">{{ $field->field_title }}</a>
                    <p class="mb-4">{{ $field->field_description }}</p>
                    <div class="d-flex align-items-center">

                        <div class="ms-3">
                            <h5>{{ $field->sportType ? $field->sportType->sport_type : 'N/A' }}</h5>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
