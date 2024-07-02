const InventaireContent = () => {
    fetch("http://localhost:8888/articles/readArticle")
    .then(response => response.json())
    .then(data =>{
        console.log(data)
    })
    return(
        <div>
            <h1> 🧮 Gestion de l'inventaire 🍷</h1>
            <div className="inventaire-content">
                <label for="ref">Référence à compter</label>
                <input type="text" id="ref" name="ref" placeholder="Référence"/>
                <label for="compte">Quantité</label>
                <input type="number" id="compte" name="compte" placeholder="Nombre"/>
            </div>
        </div>

    )
}

export default InventaireContent