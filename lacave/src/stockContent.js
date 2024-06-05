import { render } from "@testing-library/react";
import StockActuel from "./stockActuel";
import Rupture from "./rupture";
import Commande from "./commande";

const StockContent = ()=>{
    return (
      <div className='App'>
        <h1 id="GestionTitle"> 📦 Gestion de Stock 📈</h1>
        <div className='content'>
          <StockActuel/>
            <div>
                <Commande/>
            </div>
            <div>
                <Rupture/>
                
            </div>
            </div>
      </div>
    );
  }
export default StockContent