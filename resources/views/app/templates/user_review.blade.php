 <div class="col-md-12 review">
            <div class="row">
                <div class="col-md-1">
                    @if ($review->user->image && $review->user->image !== 'default_image.jpg')
                        <div class="profile-image-container review-image" style="background-image: url('{{ asset($review->user->image) }}')"></div>
                    @else
                        <div class="profile-image-container review-image" style="background-image: url('{{ asset('img/users/user.png') }}')"></div>
                    @endif
                </div>
                <div class="col-md-9 author-details-container">
                    <h4 class="author-name">
                        <a href="{{route('profile', ['id' => $review->user->id])}}" style="text-decoration: none">{{ $review->user->name }}</a>
                    </h4>
                    <div class="star-rating">
                        <i class="fas fa-star" style="margin-right: 4px;"></i>{{ $review->rating }}
                    </div>
                </div>
                <div class="col-md-12">
                    <p class="comment-title">Comentário:</p>
                    <p>{{ $review->review }}</p>
                </div>
            </div>
 </div>
