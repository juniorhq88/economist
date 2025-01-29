@props(['active' => false])

<a {{ $attributes->class(['link-base', $active ? 'link-active' : 'link-inactive']) }}>
    {{ $slot }}
</a>
