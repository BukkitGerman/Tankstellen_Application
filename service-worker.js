let cacheName = 'v1';
let cacheFiles = [
	'./index.php',
	'./js/app.js',
	'./style.css',
	'./tankapp.json',
	'./tankapp.webmanifest',
	'./data.php'
	]


self.addEventListener('install', function(e){
	console.log('[Service Worker] Installed')

	e.waitUntil(

		caches.open(cacheName).then(function(cache){
			console.log('[Service Worker] Caching cacheFiles')
			return cache.addAll(cacheFiles)
		})
	)
})

self.addEventListener('activate', function(e){
	console.log('[Service Worker] Activated')

	e.waitUntil(

		caches.keys().then(function(cacheNames){
			return Promise.all(cacheNames.map(function(thisCacheName){
				if(thisCacheName !== cacheName){
					console.log('[Service Worker] Removing Cache Files from', thisCacheName)
					return caches.delete(thisCacheName)
				}
			}))
		})

	)
})

self.addEventListener('fetch', function(e){
	console.log('[Service Worker] Fetching', e.request.url)

	e.respondWith(
		caches.match(e.request).then(function(response){
			if( response ){
				console.log("[Service Worker] Found in cache", e.request.url)
				return response
			}

			return fetch(e.request)
		})
	)
})