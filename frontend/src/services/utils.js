export const numberify = function (val) {
    return val.toLocaleString(
        undefined,
        { minimumFractionDigits: 0 }
    );
}