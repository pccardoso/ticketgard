importScripts('https://www.gstatic.com/firebasejs/10.8.0/firebase-app-compat.js');
importScripts('https://www.gstatic.com/firebasejs/10.8.0/firebase-messaging-compat.js');

firebase.initializeApp({
  apiKey: "AIzaSyAFa56-LyCqYYGsWhTSsHoSYbJa2ORuOm4",
  authDomain: "ticketgard-8ac4b.firebaseapp.com",
  projectId: "ticketgard-8ac4b",
  storageBucket: "ticketgard-8ac4b.firebasestorage.app",
  messagingSenderId: "766890449339",
  appId: "1:766890449339:web:b33af3df675a0b19698c9e",
  measurementId: "G-6W0NDBK56V"
});

const messaging = firebase.messaging();

// Recebe notificações quando a aba não está aberta
messaging.onBackgroundMessage(function(payload) {
  console.log('[firebase-messaging-sw.js] Received background message ', payload);

  const notificationTitle = payload.notification.title;
  const notificationOptions = {
    body: payload.notification.body,
    icon: '/icon.png',           // coloque um ícone válido
    data: {
      url: payload.data?.url || '/'  // pega a URL enviada no backend
    }
  };

  self.registration.showNotification(notificationTitle, notificationOptions);
});

// Evento de clique na notificação
self.addEventListener('notificationclick', function(event) {
  event.notification.close();

  const urlToOpen = event.notification.data?.url || '/';

  event.waitUntil(
    clients.matchAll({ type: 'window', includeUncontrolled: true }).then(windowClients => {
      // Se já houver uma aba aberta com a URL, foca ela
      for (let client of windowClients) {
        if (client.url === urlToOpen && 'focus' in client) {
          return client.focus();
        }
      }
      // Caso contrário, abre uma nova aba
      if (clients.openWindow) {
        return clients.openWindow(urlToOpen);
      }
    })
  );
});
