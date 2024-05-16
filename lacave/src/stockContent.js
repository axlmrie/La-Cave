import { render } from "@testing-library/react";
import StockActuel from "./stockActuel";
import Rupture from "./rupture";

const StockContent = ()=>{
    return (
      <div className='App'>
        <h1 id="GestionTitle"> 📦 Gestion de Stock 📈</h1>
        <div className='content'>
          <StockActuel/>
            <div>
                <h2>Stock en commande</h2>
            </div>
            <div>
                <Rupture/>
                
            </div>
            </div>
      </div>
    );
  }
export default StockContent