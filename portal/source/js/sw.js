// Nome da cache
const CACHE_NAME = 'duty-saude-cache-v1';

// Recursos a serem armazenados em cache
const urlsToCache = [
    '/source/img/banner.png'
];

// Instalar o Service Worker e armazenar recursos em cache
self.addEventListener('install', function (event) {
    event.waitUntil(
            caches.open(CACHE_NAME).then(function (cache) {
        return cache.addAll(urlsToCache);
    })
            );
});

// Intercepta solicitações e responde com o cache, se disponível
self.addEventListener('fetch', function (event) {
    event.respondWith(
            caches.match(event.request).then(function (response) {
        // Retorna o recurso em cache, se encontrado
        if (response) {
            return response;
        }
        // Caso contrário, busca o recurso na rede
        return fetch(event.request);
    })
            );
});

// Limpa a cache antiga
self.addEventListener('activate', function (event) {
    const cacheWhitelist = [CACHE_NAME];

    event.waitUntil(
            caches.keys().then(function (cacheNames) {
        return Promise.all(
                cacheNames.map(function (cacheName) {
                    if (cacheWhitelist.indexOf(cacheName) === -1) {
                        return caches.delete(cacheName);
                    }
                })
                );
    })
            );
});

// Atualiza a cache periodicamente (a cada 24 horas)
self.addEventListener('fetch', function (event) {
    event.respondWith(
            caches.open(CACHE_NAME).then(function (cache) {
        return cache.match(event.request).then(function (response) {
            var fetchPromise = fetch(event.request).then(function (networkResponse) {
                cache.put(event.request, networkResponse.clone());
                return networkResponse;
            });
            return response || fetchPromise;
        });
    })
            );
});