import { initializeApp } from "firebase/app";
import { getMessaging, getToken, onMessage } from "firebase/messaging";

const firebaseConfig = {
  apiKey: "AIzaSyAFa56-LyCqYYGsWhTSsHoSYbJa2ORuOm4",
  authDomain: "ticketgard-8ac4b.firebaseapp.com",
  projectId: "ticketgard-8ac4b",
  storageBucket: "ticketgard-8ac4b.firebasestorage.app",
  messagingSenderId: "766890449339",
  appId: "1:766890449339:web:b33af3df675a0b19698c9e",
  measurementId: "G-6W0NDBK56V"
};

const app = initializeApp(firebaseConfig);
const messaging = getMessaging(app);

export const requestPermissionAndGetToken = async () => {
  try {
    const permission = await Notification.requestPermission();
    if (permission !== "granted") {
      console.warn("Permissão de notificação negada.");
      return null;
    }

    // Registrar o Service Worker
    const registration = await navigator.serviceWorker.register('/firebase-messaging-sw.js');

    // Obter o token do Firebase
    const token = await getToken(messaging, {
      vapidKey: "BKoRSpPsC3FfUxvZYu80D5QvroQyVzVKloSIYvghO8aHimbgyjRHB0RcQJwvDZBrwMxzSFGzLUhlD5HsmE6vt_c",
      serviceWorkerRegistration: registration
    });

    if (!token) {
      console.warn("Nenhum token retornado pelo Firebase.");
      return null;
    }

    return token;
  } catch (err) {
    console.error("Erro ao obter token:", err);
    return null;
  }
};


export const onMessageListener = (callback) => {
  onMessage(messaging, (payload) => {
    callback(payload);
  });
};
