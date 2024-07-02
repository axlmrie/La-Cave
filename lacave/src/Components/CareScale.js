import Sun from '../Assets/sun.svg'
import Water from '../Assets/water.svg'

const quantityLabel ={
    1:'peu',
    2:'modérément',
    3:'beaucoup'
}

function CareScale({scaleValue, CareType}){
    const range =[1,2,3]
    const scaleType =CareType === 'light'?(
        <img src={Sun} alt='sun-icon'/>
        ):(
            <img src={Water} alt='water-icon'/>
        )


    return(
        <div
            onClick={()=>
                    alert(
                    `Cette plante requiert ${quantityLabel[scaleValue]}${CareType === ' light ' ? ' de lumière' : " d'arrosage " }`
                    )
                    }>
            {range.map((rangeElem)=>
                        scaleValue >= rangeElem ?(
                            <span key={rangeElem.toString()}>{scaleType}</span>
                        ):null
                        )}
        </div>
    )
}
export default CareScale