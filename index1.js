document.addEventListener("DOMContentLoaded", function () {
  // --- Contact Form Submission ---
  const form = document.querySelector(".contact-form");
  if (form) {
    form.addEventListener("submit", function (event) {
      event.preventDefault();

      const name = document.getElementById("name").value;
      const email = document.getElementById("email").value;
      const message = document.getElementById("message").value;

      if (name && email && message) {
        alert("Your message has been sent! Thank you for reaching out.");
        form.reset();
      } else {
        alert("Please fill out all fields before submitting.");
      }
    });
  }

  // --- Sidebar Toggle Logic ---
  const menuToggle = document.getElementById("menuToggle");
  const sidebar = document.getElementById("sidebar");
  const closeBtn = document.getElementById("closeBtn");
  if (menuToggle && sidebar && closeBtn) {
    const sidebarLinks = sidebar.querySelectorAll("a");

    menuToggle.addEventListener("click", () => {
      sidebar.classList.add("active");
    });

    closeBtn.addEventListener("click", () => {
      sidebar.classList.remove("active");
      menuToggle.classList.remove("active");
    });

    sidebarLinks.forEach((link) => {
      link.addEventListener("click", () => {
        sidebar.classList.remove("active");
        menuToggle.classList.remove("active");
      });
    });
  }

  // --- Carousel Logic ---
  document.querySelectorAll(".carousel").forEach((carousel) => {
    const prevButton = carousel.querySelector(".prev");
    const nextButton = carousel.querySelector(".next");
    const carouselImages = carousel.querySelector(".carousel-images");

    let index = 0;
    const items = carousel.querySelectorAll(".carousel-item");
    const totalItems = items.length;
    const itemWidth = items[0].offsetWidth;

    const showItem = () => {
      carouselImages.style.transform = `translateX(-${index * itemWidth}px)`;
    };

    prevButton.addEventListener("click", () => {
      index = index > 0 ? index - 1 : totalItems - 1;
      showItem();
    });

    nextButton.addEventListener("click", () => {
      index = index < totalItems - 1 ? index + 1 : 0;
      showItem();
    });

    showItem();
  });

  // --- Best Sellers Image Rotation ---
  const bestSellerImages = document.querySelectorAll(".best-seller-item img");
  if (bestSellerImages.length > 0) {
    let bestSellerIndex = 0;
    setInterval(() => {
      bestSellerImages.forEach((img, i) => {
        img.style.opacity = i === bestSellerIndex ? 1 : 0;
      });
      bestSellerIndex = (bestSellerIndex + 1) % bestSellerImages.length;
    }, 3000);
  }

  // --- New Flavor Image Rotation ---
  const newFlavorImages = document.querySelectorAll(".new-flavor-item");
  if (newFlavorImages.length > 0) {
    let flavorIndex = 0;
    setInterval(() => {
      newFlavorImages[flavorIndex].style.display = "none";
      flavorIndex = (flavorIndex + 1) % newFlavorImages.length;
      newFlavorImages[flavorIndex].style.display = "block";
    }, 3000);
  }

  // --- Quantity Selector Logic ---
  document.querySelectorAll(".quantity-selector").forEach((selector) => {
    const minusButton = selector.querySelector(".quantity-btn.minus");
    const plusButton = selector.querySelector(".quantity-btn.plus");
    const display = selector.querySelector(".quantity-display");

    minusButton.addEventListener("click", () => {
      const currentValue = parseInt(display.value) || 0;
      if (currentValue > 0) {
        display.value = currentValue - 1;
      }
    });

    plusButton.addEventListener("click", () => {
      const currentValue = parseInt(display.value) || 0;
      display.value = currentValue + 1;
    });
  });

  // --- Size Selector Logic ---
  document.querySelectorAll(".size-options").forEach((sizeOptions) => {
    sizeOptions.querySelectorAll(".size-button").forEach((button) => {
      button.addEventListener("click", () => {
        sizeOptions
          .querySelectorAll(".size-button")
          .forEach((btn) => btn.classList.remove("selected"));
        button.classList.add("selected");
      });
    });
  });

  // --- Add to Cart (Buy Now) Logic ---
  document.querySelectorAll(".add-to-cart").forEach((button) => {
    button.addEventListener("click", function () {
      const productCard = this.closest(".product-card");
      const shoeName = productCard.querySelector("h4").textContent;
      const shoeDetails = productCard.querySelector("p").textContent;
      const selectedSize = productCard.querySelector(".size-button.selected");
      const quantity = productCard.querySelector(".quantity-display").value;

      if (!selectedSize) {
        alert("Please select a size before adding to cart.");
        return;
      }

      if (parseInt(quantity) <= 0) {
        alert("Please select a quantity greater than 0.");
        return;
      }

      const cartItem = {
        name: shoeName,
        details: shoeDetails,
        size: selectedSize.textContent,
        quantity: quantity,
      };

      console.log("Added to Cart:", cartItem);

      alert(
        `Added to Cart: ${shoeName} (${shoeDetails}), Size ${cartItem.size}, Quantity: ${cartItem.quantity}`
      );

      // Reset size and quantity after adding to cart
      productCard
        .querySelectorAll(".size-button")
        .forEach((btn) => btn.classList.remove("selected"));
      productCard.querySelector(".quantity-display").value = "0";

      // --- Update Stock in Database (NEW MERGED LOGIC) ---
      const shoeId = productCard.getAttribute("data-id");

      if (shoeId) {
        fetch("update_stock.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/x-www-form-urlencoded",
          },
          body: `id=${shoeId}&quantity=${cartItem.quantity}`,
        })
          .then((response) => response.json())
          .then((data) => {
            if (data.success) {
              alert("Ordered successfully!");
              location.reload(); // Reload page to show new stock
            } else {
              alert("Failed to Order. Please try again.");
            }
          })
          .catch((error) => console.error("Error:", error));
      }
    });
  });
});
