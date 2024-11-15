const InventaireContent = () => {

    const count = () => {
        const id = document.getElementById("ref").value
        const compte = document.getElementById("compte").value
        try{
        fetch(`http://localhost:8080/articles/${id}/stock/${compte}`, {
            method: 'PUT',
            cache:"no-cache",
            headers: {
                'Content-Type': 'application/json',
            }})
        .then(response => response.text())
        .then(data => {
            if(data !== "Changement effectué"){
                alert("Erreur lors du changement")
            }else{
                window.location.reload()
            }
        })}
        catch{
            alert("Erreur")
        }
    }
    return(
        <div>
            <h1> 🧮 Gestion de l'inventaire 🍷</h1>
            <div className="inventaire-content">
                <label for="ref">Référence à compter (Id)</label>
                <input type="text" id="ref" name="ref" placeholder="Référence"/>
                <label for="compte">Quantité</label>
                <input type="number" id="compte" name="compte" placeholder="Nombre"/>
                <div onClick={count}> Soumettre</div>
            </div>
        </div>

    )
}

export default InventaireContent