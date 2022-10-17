/*since javaScript is not class based, lets use this function as facade */
/* used to set style of HTML elements*/
export function setStyle(elements, prop, val) {
    elements.forEach(element => {
      document.querySelector(element).style[prop]=val;
    });
  }
  