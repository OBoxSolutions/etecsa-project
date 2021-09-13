export default function isInDanger(indicator, ner) {
    if (indicator === "ldne" && ner < 97.1) {
        return true;
    }
    if (indicator === "ldie" && ner < 92) {
        return true;
    }
    return false;
}
