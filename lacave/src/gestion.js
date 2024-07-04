import Header from "./header"
import './App.css';
import { useState, useEffect } from "react";
import Utilisateurs from "./utilisateurs";
import Fournisseur from "./fournisseurs";
import Vins from "./vin";

const Gestion =() => {
    

    return (
        <div className="App">
            <Header/>
            <Utilisateurs/>
            <Fournisseur/>
            <Vins/>
        </div>
    )
}

export default Gestion