self.addEventListener('install', (e) => {
    console.log('[Service Worker] Install');
});

caches.open('v1').then(function(cache){
 cache.delete('data.php').then(function(response){
    console.log('[Service Worker] Cache DATA cleard');
 });
 cache.delete('style.css').then(function(response){
    console.log('[Service Worker] Cache CSS cleard');
 });  
})

self.addEventListener('fetch', (e) => {
  e.respondWith(
    caches.match(e.request).then((r) => {
          console.log('[Service Worker] Fetching resource: '+e.request.url);
      return r || fetch(e.request).then((response) => {
                return caches.open("Tankapp").then((cache) => {
          console.log('[Service Worker] Caching new resource: '+e.request.url);
          cache.put(e.request, response.clone());
          cache.delete("Tankapp")
          return response;  
        });
      });
    })
  );
});