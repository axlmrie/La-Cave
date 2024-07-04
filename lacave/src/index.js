import React from 'react';
import ReactDOM from 'react-dom/client';
import './index.css';
import App from './App';
import Stock from './stock';
import Inventaire from './inventaire';
import Boutique from './Components/App';
import {
  createBrowserRouter,
  RouterProvider,
} from "react-router-dom";
import Connexion from './Components/pageConnexion/connexion';
import Gestion from './gestion';



const router = createBrowserRouter([
  {
    path: "/",
    element: <App/>,
  },{path : "/stock",
  element : <Stock/>},
  {path : "/inventaire",
  element : <Inventaire/>},
  {path : "/boutique",
    element : <Boutique/>},
    {path: "/connexion",
      element : <Connexion/>
    },{
      path: "/gestion",
      element: <Gestion/>,
    }
]);

ReactDOM.createRoot(document.getElementById("root")).render(
  <React.StrictMode>
    
    <RouterProvider router={router} />
    
  </React.StrictMode>
);

// If you want to start measuring performance in your app, pass a function
// to log results (for example: reportWebVitals(console.log))
// or send to an analytics endpoint. Learn more: https://bit.ly/CRA-vitals

