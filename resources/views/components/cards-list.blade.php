<div class="cards-list col-12">
    @if (count($offers) === 0)
        <p class="cards-list__empty">{{ __('content.there are no', ['item' => 'offers']) }}</p>
    @else
        <div class="card-group">
            @foreach($offers as $offer)
                <div class="card shadow">
                    <div class="card__shutter">{{ $offer->industry }}</div>
                    <div class="card__window">
                        <img src="{{ asset('storage/images/' . $offer->picture) }}" alt="Offer card image" class="card-img-top horizontally-centered grayscale">
                    </div>

                    <div class="card-body mb-2">
                        <h5 class="card-body__title"><a href="/internship/{{ $offer->id }}">{{ $offer->title }}</a></h5>
                        <div class="card-body__subtitle mb-3">
                            <p class="card-text"><strong>{{ strtoupper($offer->location) }}</strong></p>
                            <p class="card-text">{{ trans_choice('content.staying', $offer->duration, ['time' => $offer->duration ]) }}</p>
                        </div>
                        <div class="card-body__action">
                            @auth
                                @if (Auth::user()->program === 'internship' || Auth::user()->program === 'inter_relocat')
                                    @if(!array_key_exists($offer->industry, Auth::user()->industry))
                                        @component('components.forms.card-form', [
                                            'hidden' => [
                                                'program' => 'industry',
                                                'industry' => $offer->industry
                                            ],
                                            'buttons' => [
                                                [
                                                    'content' => Auth::user()->industry === null ? __('content.apply for') : __('Add Preference'),
                                                    'value' => 'inter_relocat',
                                                ],
                                                [
                                                    'href' => '/internship/' . $offer->id,
                                                    'content' => __('content.description'),
                                                ],
                                            ],
                                        ])
                                        @slot('action', route('update.program', ['user' => Auth::user()->id, 'program' => Auth::user()->program]))

                                        @endcomponent
                                    @endif
                                @else
                                    @component('components.forms.card-form', [
                                        'hidden' => [
                                            'program' => 'industry',
                                            'industry' => $offer->industry
                                        ],
                                        'buttons' => [
                                            [
                                                'content' => __('Change Preference'),
                                                'value' => 'inter_relocat',
                                            ],
                                            [
                                                'href' => '/internship/' . $offer->id,
                                                'content' => __('content.description'),
                                                'value' => $offer->industry
                                            ]
                                        ],
                                    ])

                                        @slot('action', route('update.program', ['user' => Auth::user()->id, 'program' => Auth::user()->program]))

                                    @endcomponent
                                @endif
                            @else
                                @component('components.forms.card-form', [
                                    'hidden' => [
                                        'program' => 'industry',
                                        'industry' => $offer->industry
                                    ],
                                    'buttons' => [
                                        [
                                            'content' => __('content.apply for'),
                                            'value' => 'inter_relocat'
                                        ],
                                        [
                                            'href' => '/internship/' . $offer->id,
                                            'content' => __('content.description'),
                                            'value' => $offer->industry,
                                        ],
                                    ],
                                ])

                                    @slot('action', route('application.form'))

                                @endcomponent
                            @endauth
                        </div>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted">{{ \Carbon\Carbon::parse($offer->created_at)->diffForHumans(Carbon\Carbon::now()) }}</small>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    {!! isset($pagination) ? $pagination : $offers->links('vendor.pagination.semantic-ui') !!}
</div>