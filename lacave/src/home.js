import { Fragment,useState} from "react";
import React from "react";



const Home = () => {
    function Alerte({ nombre }) {
        if (nombre > 0) {
          return <span> {nombre} Produits en rupture</span>;
        }
        return <span>Pas d'Alerte pour le moments</span>;
      }
    const rupture =()=>{
        fetch("http://localhost:8000/donnees")
        .then(response => response.json())
        .then(data => {
        setLenRupture(data.rowCount)})
    }    
    const [lenRupture,setLenRupture] = useState(0)
    const test = 0
    rupture()
    return(
        <div>
            <h1>Outil de Gestion La Cave 🍷</h1>
            <div className="Choix">
                
            <div className="inventaire">
                <h2>Dernière référence inventoriée 📦</h2>
                <span> ref untel 7 Quantité </span>
            </div>
            <div className="inventaire">
                <h2>Alerte Stock 📈</h2>
                <Alerte nombre={lenRupture}/>
            </div>
    
            </div>

        </div>
    )
}

export default Home;