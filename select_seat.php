
<!DOCTYPE html>
<html lang="en">

<head>
  <title>CSS seat booking</title>
  <style>
    * {
      box-sizing: border-box;
    }

    body {
      font-size: 16px;
      background: black;
    }

    .plane {
      margin: 20px auto;
      max-width: 300px;
      background: white;
    }

    .select {
      height: 250px;
      position: relative;
      overflow: hidden;
      text-align: center;
    }

    .select h1 {
      width: 60%;
      margin: 100px auto 35px auto;
    }

    .exit {
      position: relative;
      height: 50px;
    }

    .exit:before,
    .exit:after {
      content: "EXIT";
      font-size: 14px;
      line-height: 18px;
      padding: 0px 2px 2px 2px;
      display: block;
      position: absolute;
      background: red;
      color: white;
      top: 50%;
      transform: translate(0, -50%);
      border-radius: 5px;
    }

    .exit:before {
      left: 10px;
    }

    .exit:after {
      right: 10px;
    }

    ol {
      list-style: none;
      padding: 0;
      margin: 0;
    }

    .seats {
      display: flex;
      flex-direction: row;
      flex-wrap: nowrap;
      justify-content: flex-start;
    }

    .seat {
      display: flex;
      flex: 0 0 14.28%;
      padding: 5px;
      position: relative;
    }

    .seat label {
      display: block;
      position: relative;
      width: 100%;
      text-align: center;
      font-size: 14px;
      font-weight: bolder;
      line-height: 1.5rem;
      padding: 4px 0;
      background: #5bfc60;
      border-radius: 5px;
      color: black;
    }

    .seat label:hover {
      cursor: pointer;
      box-shadow: 0 0 0px 2px green;
    }

    .seat:nth-child(3) {
      margin-right: 14%;
    }

    .seat input[type=checkbox] {
      position: absolute;
    }

    .seat input[type=checkbox]:checked+label {
      background: #656e65;
    }
    
    /* Next button style */
    .next-button {
      position: fixed;
      bottom: 20px;
      right: 20px;
      background-color: #4CAF50;
      color: white;
      border: none;
      border-radius: 5px;
      padding: 30px 60px; /* 3 times bigger */
      cursor: pointer;
      font-size: 16px;
    }
  </style>
</head>

<body>
  <div class="plane">
    <div class="select">
      <h1>Please select a seat</h1>
    </div>
    <div class="exit"></div>
    <ol>
      <li>
        <ol class="seats">
          <li class="seat">
            <input type="checkbox" id="1A" />
            <label for="1A">1A</label>
          </li>
          <li class="seat">
            <input type="checkbox" id="1B" />
            <label for="1B">1B</label>
          </li>
          <li class="seat">
            <input type="checkbox" id="1C" />
            <label for="1C">1C</label>
          </li>
          <li class="seat">
            <input type="checkbox" id="1D" />
            <label for="1D">1D</label>
          </li>
        </ol>
      </li>
      <li>
        <ol class="seats">
          <li class="seat">
            <input type="checkbox" id="2A" />
            <label for="2A">2A</label>
          </li>
          <li class="seat">
            <input type="checkbox" id="2B" />
            <label for="2B">2B</label>
          </li>
          <li class="seat">
            <input type="checkbox" id="2C" />
            <label for="2C">2C</label>
          </li>
          <li class="seat">
            <input type="checkbox" id="2D" />
            <label for="2D">2D</label>
          </li>
        </ol>
      </li>
      <li>
      <ol class="seats">
        <li class="seat">
          <input type="checkbox" id="3A" />
          <label for="3A">3A</label>
        </li>
        <li class="seat">
          <input type="checkbox" id="3B" />
          <label for="3B">3B</label>
        </li>
        <li class="seat">
          <input type="checkbox" id="3C" />
          <label for="3C">3C</label>
        </li>
        <li class="seat">
          <input type="checkbox" id="3D" />
          <label for="3D">3D</label>
        </li>
      </ol>
    </li>
    <li>
      <ol class="seats">
        <li class="seat">
          <input type="checkbox" id="4A" />
          <label for="4A">4A</label>
        </li>
        <li class="seat">
          <input type="checkbox" id="4B" />
          <label for="4B">4B</label>
        </li>
        <li class="seat">
          <input type="checkbox" id="4C" />
          <label for="4C">4C</label>
        </li>
        <li class="seat">
          <input type="checkbox" id="4D" />
          <label for="4D">4D</label>
        </li>
      </ol>
    </li>
    <li>
      <ol class="seats">
        <li class="seat">
          <input type="checkbox" id="5A" />
          <label for="5A">5A</label>
        </li>
        <li class="seat">
          <input type="checkbox" id="5B" />
          <label for="5B">5B</label>
        </li>
        <li class="seat">
          <input type="checkbox" id="5C" />
          <label for="5C">5C</label>
        </li>
        <li class="seat">
          <input type="checkbox" id="5D" />
          <label for="5D">5D</label>
        </li>
      </ol>
    </li>
    <li>
      <ol class="seats">
        <li class="seat">
          <input type="checkbox" id="6A" />
          <label for="6A">6A</label>
        </li>
        <li class="seat">
          <input type="checkbox" id="6B" />
          <label for="6B">6B</label>
        </li>
        <li class="seat">
          <input type="checkbox" id="6C" />
          <label for="6C">6C</label>
        </li>
        <li class="seat">
          <input type="checkbox" id="6D" />
          <label for="6D">6D</label>
        </li>
      </ol>
    </li>
    <li>
      <ol class="seats">
        <li class="seat">
          <input type="checkbox" id="7A" />
          <label for="7A">7A</label>
        </li>
        <li class="seat">
          <input type="checkbox" id="7B" />
          <label for="7B">7B</label>
        </li>
        <li class="seat">
          <input type="checkbox" id="7C" />
          <label for="7C">7C</label>
        </li>
        <li class="seat">
          <input type="checkbox" id="7D" />
          <label for="7D">7D</label>
        </li>
      </ol>
    </li>
    <li>
      <ol class="seats">
        <li class="seat">
          <input type="checkbox" id="8A" />
          <label for="8A">8A</label>
        </li>
        <li class="seat">
          <input type="checkbox" id="8B" />
          <label for="8B">8B</label>
        </li>
        <li class="seat">
          <input type="checkbox" id="8C" />
          <label for="8C">8C</label>
        </li>
        <li class="seat">
          <input type="checkbox" id="8D" />
          <label for="8D">8D</label>
        </li>
      </ol>
    </li>
    <li>
      <ol class="seats">
        <li class="seat">
          <input type="checkbox" id="9A" />
          <label for="9A">9A</label>
        </li>
        <li class="seat">
          <input type="checkbox" id="9B" />
          <label for="9B">9B</label>
        </li>
        <li class="seat">
          <input type="checkbox" id="9C" />
          <label for="9C">9C</label>
        </li>
        <li class="seat">
          <input type="checkbox" id="9D" />
          <label for="9D">9D</label>
        </li>
      </ol>
    </li>
    <li>
      <ol class="seats">
        <li class="seat">
          <input type="checkbox" id="10A" />
          <label for="10A">10A</label>
        </li>
        <li class="seat">
          <input type="checkbox" id="10B" />
          <label for="10B">10B</label>
        </li>
        <li class="seat">
          <input type="checkbox" id="10C" />
          <label for="10C">10C</label>
        </li>
        <li class="seat">
          <input type="checkbox" id="10D" />
          <label for="10D">10D</label>
        </li>
      </ol>
    </li>
    </ol>
    <div class="exit"></div>
  </div>
  <a href="final_booking.php" class="next-button">Next</a>
</body>

</html>


