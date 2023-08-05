import { useAtom } from "jotai";
import { useEffect, useState } from "react";
import { chatStore } from "../state/chat";

export default function Chats() {
    const [laoding, setLoading] = useState(true);
    const [error, setError] = useState(false);
    const [chats, setChats] = useState([]);
    const [_, setChatStore] = useAtom(chatStore);

    function updateChat(chat_id, username) {
        setChatStore({ reciepent: username, chatId: chat_id });
    }

    useEffect(() => {
        async function fetchChats() {
            const req = await fetch("/api/chats").catch((err) => {
                setLoading(false);
                setError(true);
            });

            const data = await req.json();

            setLoading(false);
            setChats(data);
        }
        fetchChats();
    }, []);

    if (laoding) {
        return <div>Loading...</div>;
    }

    if (error) {
        return <div>Error...</div>;
    }

    return (
        <div>
            <div className="d-flex flex-column">
                {chats.length ? (
                    chats.map((chat) => (
                        <div
                            className="p-2"
                            style={{ cursor: "pointer" }}
                            key={chat.chat_id}
                            onClick={() =>
                                updateChat(chat.chat_id, chat.username)
                            }
                        >
                            {chat.username}
                        </div>
                    ))
                ) : (
                    <div>No chats Yet! Add One</div>
                )}
            </div>
        </div>
    );
}
