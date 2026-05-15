const CACHE_NAME = 'hailerz-v2';
const ASSETS_TO_CACHE = [
    '/',
    '/images/logo.webp',
    '/manifest.json'
];

self.addEventListener('install', (event) => {
    self.skipWaiting();
    event.waitUntil(
        caches.open(CACHE_NAME).then((cache) => {
            return cache.addAll(ASSETS_TO_CACHE);
        })
    );
});

self.addEventListener('activate', (event) => {
    self.clients.claim();
    event.waitUntil(
        caches.keys().then((cacheNames) => {
            return Promise.all(
                cacheNames.map((cacheName) => {
                    if (cacheName !== CACHE_NAME) {
                        console.log('Deleting old cache:', cacheName);
                        return caches.delete(cacheName);
                    }
                    return Promise.resolve();
                })
            );
        })
    );
});

self.addEventListener('fetch', (event) => {
    // For navigation requests (the HTML page itself), use a Network-First strategy.
    // This ensures that when the site is updated (and CSS hashes change), the user gets the new HTML.
    if (event.request.mode === 'navigate') {
        event.respondWith(
            fetch(event.request).catch(() => {
                return caches.match(event.request);
            })
        );
        return;
    }

    // For other assets, use Cache-First with Network fallback
    event.respondWith(
        caches.match(event.request).then((response) => {
            return response || fetch(event.request);
        })
    );
});
