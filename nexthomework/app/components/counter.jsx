"use client"

import { useState } from "react";

export default function Counter({increment, color}){
    let [count, setCount] = useState(0)

    //adding and subtracting functions
    const handle_add = () =>{
        let newCount = count + increment;
        setCount(newCount);
        if(count >= 10){
            setCount(0);
        }
    }

    const handle_sub = () => {
        let newCount = count - increment;
        setCount(newCount);
        if(count >= 10){
            setCount(0);
        }
    }

    return(
        <div>
            <div style={{
                display: 'flex',
                alignItems: 'center',
                gap: '10px'}}>
                <span style={{
                    backgroundColor: color,
                    padding: '10px 40px',
                    borderRadius: '5px',
                    minWidth: '30px',
                    textAlign: 'center',
                    margin: '1em'
                }}>
                    {count}
                </span>
                <button onClick={handle_sub} style={{backgroundColor: color}}>-</button>
                <button onClick={handle_add} style={{backgroundColor: color}}>+</button>
            </div>
        </div>
    );
}