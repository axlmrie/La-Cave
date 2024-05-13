import { useState } from "react";

function Home () {

    const [data, setData] = useState([]);

    return(
        <div>
            <div className="Choix">
                <div className="Stock">Stock</div>
                <div className="Inv">Inventaire</div>
            </div>
            <div className="inventaire">
                <h2>Dernière référence inventoriée</h2>
                <span> ref untel 7 Quantité </span>
            </div>
            <div className="inventaire">
                <h2>Alerte Stock</h2>
                <span> Pas d'alerte stock bon</span>
            </div>
        </div>
    )
}

export default Home;