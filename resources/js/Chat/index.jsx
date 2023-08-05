import { useEffect, useState } from "react";
import { chatStore } from "../state/chat";
import { useAtomValue } from "jotai";
import { userStore } from "../state/user";

function EmptyChat() {
    return <div className="text-center">Choose a chat</div>;
}

function Message({ member_id, body, path }) {
    const user = useAtomValue(userStore);
    const isCurrentUser = member_id === user.id;

    return (
        <div
            className={
                "border p-2 m-1" +
                (isCurrentUser ? " ms-auto bg-dark text-light" : " ")
            }
            style={{ width: "max-content" }}
        >
            {body ? body : null}
            {path ? "File" : null}
        </div>
    );
}

export default function Chat() {
    const chat = useAtomValue(chatStore);
    // const [loading, setLoading] = useState(false);
    // const [error, setError] = useState(false);
    const [messages, setMessages] = useState([]);

    useEffect(() => {
        async function fetchMessages() {
            const req = await fetch(`/api/chats/${chat.chatId}/messages`);
            const data = await req.json();
            setMessages(data);
            console.log(data);
        }
        if (chat.chatId) {
            fetchMessages();
        }
    }, [chat.chatId]);

    return (
        <>
            {chat.reciepent ? (
                <div>
                    <div className="reciepent border-bottom">
                        {chat.reciepent?.username}
                    </div>
                    <div className="chat d-flex flex-column">
                        {messages.length ? (
                            messages.map((message) => (
                                <Message key={message.id} {...message} />
                            ))
                        ) : (
                            <p className="text-center">Chat is Empty</p>
                        )}
                    </div>
                </div>
            ) : (
                <div>
                    <EmptyChat />
                </div>
            )}
        </>
    );
}
