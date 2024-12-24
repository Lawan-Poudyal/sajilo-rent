
import { rooms } from "./data/rooms-info.js";


let roomsHTML = ``;

rooms.forEach((room) => {
  roomsHTML += `<div class="product-container">
          <div class="product-image-container">
            <img
              src="${room.image}"
              class="product-img"
            />
          </div>

          <div class="product-title limit-to-2-lines">${room.name}</div>
          <div class="product-rating">
            <img
              src="../../resources/ratings/rating-${room.rating.stars * 10}.png"
              class="product-rating-star"
            />
            <span class="product-rating-count">${room.rating.count}</span>
          </div>
          <div class="product-price">$${room.price}</div>
          <div class="product-quantity">
            <select class=js-quantity-selector-${room.id}>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
              <option value="7">7</option>
              <option value="8">8</option>
              <option value="9">9</option>
              <option value="10">10</option>
            </select>
          </div>
          <div class="product-spacer"></div>
          <div class="added-to-cart">
            <img src="../images/icons/checkmark.png" />
            Added
          </div>
          <button class="add-to-cart-button button-primary js-add-to-cart-button" data-product-id=${room.id
    }>Add to Cart</button>
        </div>`;
});
document.querySelector(".js-room-container-grid").innerHTML = roomsHTML;

console.log("HI")
// function displayCartQuantity() {
//   const cartQuantity = calculateCartQuantity();
//   document.querySelector(".js-cart-quantity").innerHTML = cartQuantity;
// }
