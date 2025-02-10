import Echo from "laravel-echo";
import Pusher from "pusher-js";
import { useEffect } from "react";

/*
* Establish WebSocket connection for real-time transaction updates
*/
export default function useEcho(){
    useEffect(() => {
        if(!window.Pusher) window.Pusher = Pusher
    
        if(!window.Echo) window.Echo = new Echo({
            broadcaster: 'reverb',
            key: import.meta.env.VITE_REVERB_APP_KEY,
            wsHost: import.meta.env.VITE_REVERB_HOST,
            wsPort: import.meta.env.VITE_REVERB_PORT ?? 80,
            wssPort: import.meta.env.VITE_REVERB_PORT ?? 443,
            forceTLS: (import.meta.env.VITE_REVERB_SCHEME ?? 'https') === 'https',
            enabledTransports: ['ws', 'wss'],
        })
    }, [])
}