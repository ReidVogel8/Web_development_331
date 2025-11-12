import React from 'react'
import Counter from "@/app/components/counter";
import Github from "@/app/components/github";

import ReactDOM from 'react-dom'

import {jsx} from "react/jsx-runtime";

export default function Home() {
  return (
      <main style={{ padding: "2rem", fontFamily: "sans-serif" }}>
          <h1>NextJS Homework</h1>

          <h2>Counters</h2>
          <Counter increment={1} color="lightblue" />
          <Counter increment={2} color="lightgreen" />

          <h3>Github Link</h3>
          <Github />

          <h3>Check out my fake store</h3>
          <a href={"/store"}>Link_to_Store</a>
      </main>
  );
}



