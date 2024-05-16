import CareScale from "./CareScale";
import '../Styles/PlantItem.css'



function handleClick(plantName){
    alert(`vous voulez acheter 1 ${plantName}? Très bon choix`)
}

function PlantItem({id,cover,name,water,light,price}){
    return(
        <li className="lmj-plant-item" onClick={() => handleClick(name)}>
            <span className="lmj-plant-item-price">{price}€</span>
            <img className="lmj-plant-item-cover" src={cover} alt={`${name} cover`}/>
            {name}
            <div>
                <CareScale CareType='water' scaleValue={water}/>
                <CareScale CareType='light' scaleValue={light}/>
            </div>
        </li>
    )
}

export default PlantItem