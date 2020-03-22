@slot('variant', 'secondary')
@slot('header', __('component.header.home'))

@slot('input', [
    'name' => 'cta-button',
    'variant' => 'primary',
    'href' => route('internship'),
    'content' => __('Open Positions'),
    'fas' => 'chevron-right'
])