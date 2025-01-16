
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
          <div class="product-price">Rs ${room.price}</div>
          
          <div class="product-spacer"></div>
          <div class="added-to-cart">
            <img src="../images/icons/checkmark.png" />
            Added
          </div>
          <a href="../../studentsection/index.html">
          <button class="add-to-cart-button button-primary js-add-to-cart-button" data-product-id=${room.id
    }>Location</button>
    </a>
        </div>`;
});
document.querySelector(".js-room-container-grid").innerHTML = roomsHTML;

console.log("HI")
// function displayCartQuantity() {
//   const cartQuantity = calculateCartQuantity();
//   document.querySelector(".js-cart-quantity").innerHTML = cartQuantity;
// }
