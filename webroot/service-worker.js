
const cacheName = 'Hpsingh - PWA';
const static_Assets = ["./"];

self.addEventListener('install', async event => {
    const cache = await caches.open(cacheName);
    await cache.addAll(static_Assets);
});

self.addEventListener('fetch', async event => {
    const req = event.request;

    if (/.*(json|png|jpg|svg|jpeg|js|css|mp4|gif|webp)$/.test(req.url)) {
        event.respondWith(cacheFirst(req));
        //event.respondWith(networkFirst(req));
    } else {
        event.respondWith(networkFirst(req));
    }
});

async function cacheFirst(req) {
    const cache = await caches.open(cacheName);
    const cachedResponse = await cache.match(req);
    return cachedResponse || networkFirst(req);
}

async function networkFirst(req) {
    const cache = await caches.open(cacheName);
    try {
        const fresh = await fetch(req);
        cache.put(req, fresh.clone());
        return fresh;
    } catch (e) {
        const cachedResponse = await cache.match(req);
        return cachedResponse;
    }
}
