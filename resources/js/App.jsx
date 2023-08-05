import "bootstrap/dist/css/bootstrap.min.css";
import Chats from "./Chats";
import Chat from "./Chat";
import { useAtom } from "jotai";
import { useEffect } from "react";
import { userStore } from "./state/user";

export default function App() {
    const [user, setUser] = useAtom(userStore);

    useEffect(() => {
        async function fetchUser() {
            const req = await fetch("/api/user");
            const data = await req.json();
            setUser(data);
            console.log(data);
        }
        fetchUser();
    }, []);

    return (
        <div>
            {user ? (
                <div className="row mx-0" style={{ height: "100vh" }}>
                    <div className="col-3 px-0 border-end">
                        <div className="border-bottom">
                            <div className="m-2">
                                <h4>Signed in As :</h4>
                                {user.username}
                            </div>
                        </div>
                        <Chats />
                    </div>
                    <div className="col-9 px-0">
                        <Chat />
                    </div>
                </div>
            ) : (
                <h2>Loading...</h2>
            )}
        </div>
    );
}
