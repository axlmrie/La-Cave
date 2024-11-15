import '../Styles/PlantItem.css';
import cartIcon from '../Assets/panier.png'; // Assurez-vous d'avoir une image de panier



function PlantItem({ cover, name, conditionnement,id,idFournisseur, reference, price, addToCart }) {
    return (
        <li className="lmj-plant-item">
            <span className="lmj-plant-item-price">{price}€</span>
            <div className="lmj-plant-item-image-container" onClick={() => addToCart(name, price, id , idFournisseur)}>
                <img className="lmj-plant-item-cover" src={cover} alt={`${name} cover`} />
                <img className="lmj-plant-item-cart-icon" src={cartIcon} alt="Add to cart" />
            </div>
            {name}
            <div>
                <p>Conditionnement : {conditionnement}</p>
                <p>Référence : {reference}</p>
            </div>
        </li>
    );
}

export default PlantItem;
